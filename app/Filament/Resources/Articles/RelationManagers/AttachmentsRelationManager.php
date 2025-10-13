<?php

namespace App\Filament\Resources\Articles\RelationManagers;

use App\Filament\Helpers;
use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Models\Article;
use App\Models\Attachment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AttachmentsRelationManager extends RelationManager
{
    protected static ?string $title = 'Médias';
    protected static string $relationship = 'attachments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('thumbnail_path')->label("Aperçu"),
                ...Helpers::systemColumns(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('mime_type')->label("Type"),
                CheckboxColumn::make('illustrates')
                    ->label("Illustration")
                    ->disabled(function (Attachment $attachment, Component $livewire) {
                        if ($livewire->pageClass !== EditArticle::class) {
                            return true;
                        }
                        return !$attachment->isImage();
                    })
                    ->beforeStateUpdated(function (Attachment $attachment, bool $state) {
                        if (!$state) return;
                        DB::table('article_attachment')
                            ->where('article_id', $attachment->pivot_article_id)
                            ->update(['illustrates' => false]);
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make("Ajouter un fichier")
                    ->visible(function (Component $livewire) {
                        return $livewire->pageClass === EditArticle::class;
                    })
                    ->schema([
                        FileUpload::make('file')
                            ->label("Fichier")
                            ->storeFiles(false),
                        Textarea::make('description'),
                    ])
                    ->action(function (array $data) {
                        /** @var Article $article */
                        $article = $this->getOwnerRecord();
                        $article->attach($data['file'], $data['description']);
                    }),
            ])
            ->recordUrl(false)
            ->recordActions([
                ViewAction::make()
                    ->label("Ouvrir")
                    ->url(function (Attachment $attachment) {
                        return $attachment->url();
                    })
                    ->openUrlInNewTab(),
                EditAction::make(),
                DetachAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getTabComponent(Model $ownerRecord, string $pageClass): Tab
    {
        return Tab::make('Médias')->badge($ownerRecord->attachments()->count());
    }
}

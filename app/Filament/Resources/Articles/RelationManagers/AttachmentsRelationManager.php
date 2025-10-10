<?php

namespace App\Filament\Resources\Articles\RelationManagers;

use App\Filament\Helpers;
use App\Models\Article;
use App\Models\Attachment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                ...Helpers::systemColumns(),
                ImageColumn::make('preview')
                    ->label("Aperçu")
                    ->state(function (Attachment $attachment) {
                        return $attachment->isImage() ? $attachment->path : null;
                    })
                    ->imageSize(80),
                TextColumn::make('name')->searchable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('mime_type')->label("Type"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make("Ajouter un fichier")
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
            ->recordActions([
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
}

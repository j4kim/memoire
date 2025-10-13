<?php

namespace App\Filament\Resources\People\RelationManagers;

use App\Filament\Helpers;
use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';
    protected static ?string $title = 'Objets liées à cette personne';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('ref')->searchable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('role')->label("Rôle"),
            ])
            ->headerActions([
                AttachAction::make()->schema(fn(AttachAction $action): array => [
                    $action->getRecordSelect(),
                    Helpers::roleSelect(),
                ]),
            ])
            ->recordActions([
                DetachAction::make(),
                EditAction::make()->schema([
                    Helpers::roleSelect(),
                ])->modalWidth(Width::Large),
                ViewAction::make()->url(function (Article $article) {
                    return ArticleResource::getUrl('view', ['record' => $article]);
                }),
            ]);
    }

    public static function getTabComponent(Model $ownerRecord, string $pageClass): Tab
    {
        return Tab::make('Objets')->badge($ownerRecord->articles()->count());
    }
}

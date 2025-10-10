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
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    TextInput::make('role'),
                ]),
            ])
            ->recordActions([
                DetachAction::make(),
                EditAction::make()->schema([
                    TextInput::make('role'),
                ])->modalWidth(Width::Large),
                ViewAction::make()->url(function (Article $article) {
                    return ArticleResource::getUrl('view', ['record' => $article]);
                }),
            ]);
    }
}

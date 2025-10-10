<?php

namespace App\Filament\Resources\People\RelationManagers;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\DetachAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    protected static ?string $relatedResource = ArticleResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordActions([
                DetachAction::make(),
                ViewAction::make(),
            ]);
    }
}

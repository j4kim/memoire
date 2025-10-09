<?php

namespace App\Filament\Resources\Lots\RelationManagers;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DissociateAction;
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
            ->headerActions([
                AssociateAction::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                DissociateAction::make(),
                ViewAction::make(),
            ]);
    }
}

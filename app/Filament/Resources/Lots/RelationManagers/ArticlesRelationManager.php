<?php

namespace App\Filament\Resources\Lots\RelationManagers;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Lots\Pages\EditLot;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\AssociateAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Width;
use Filament\Tables\Table;
use Livewire\Component;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    protected static ?string $relatedResource = ArticleResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                AssociateAction::make(),
                Action::make('create')
                    ->label("Créer")
                    ->schema([
                        TextInput::make('title')->required(),
                    ])
                    ->modalWidth(Width::Large)
                    ->modalHeading("Créer un objet dans ce lot")
                    ->modalSubmitActionLabel('Créer')
                    ->action(function (array $data, Component $livewire) {
                        /** @var Lot $lot */
                        $lot = $this->getOwnerRecord();
                        $article = Article::create([
                            ...$data,
                            'lot_id' => $lot->id,
                            'ref' => Article::getNextRefFromBase($lot->ref),
                        ]);
                        $livewire->redirect(ArticleResource::getUrl('view', ['record' => $article]));
                    })->visible(function (Component $livewire) {
                        return $livewire->pageClass === EditLot::class;
                    }),
            ])
            ->recordActions([
                DissociateAction::make(),
                ViewAction::make(),
            ]);
    }
}

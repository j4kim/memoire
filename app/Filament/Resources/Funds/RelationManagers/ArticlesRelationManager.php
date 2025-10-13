<?php

namespace App\Filament\Resources\Funds\RelationManagers;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Funds\Pages\EditFund;
use App\Filament\Resources\Lots\LotResource;
use App\Models\Article;
use App\Models\Lot;
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
    protected static ?string $title = 'Objets dans ce fond';

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
                    ->modalHeading("Créer un objet dans ce fond")
                    ->modalSubmitActionLabel('Créer')
                    ->action(function (array $data, Component $livewire) {
                        /** @var Fund $fund */
                        $fund = $this->getOwnerRecord();
                        $article = Article::create([
                            ...$data,
                            'fund_id' => $fund->id,
                            'ref' => Article::getNextRefFromBase($fund->ref),
                        ]);
                        $livewire->redirect(ArticleResource::getUrl('view', ['record' => $article]));
                    })->visible(function (Component $livewire) {
                        return $livewire->pageClass === EditFund::class;
                    }),
            ])
            ->recordActions([
                DissociateAction::make(),
                ViewAction::make(),
            ]);
    }
}

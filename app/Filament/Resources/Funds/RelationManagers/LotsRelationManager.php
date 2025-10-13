<?php

namespace App\Filament\Resources\Funds\RelationManagers;

use App\Filament\Resources\Funds\Pages\EditFund;
use App\Filament\Resources\Lots\LotResource;
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

class LotsRelationManager extends RelationManager
{
    protected static string $relationship = 'lots';
    protected static ?string $title = 'Lots dans ce fond';

    protected static ?string $relatedResource = LotResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                AssociateAction::make(),
                Action::make('create')
                    ->label("Créer")
                    ->schema([
                        TextInput::make('name')->required(),
                    ])
                    ->modalWidth(Width::Large)
                    ->modalHeading("Créer un lot dans ce fond")
                    ->modalSubmitActionLabel('Créer')
                    ->action(function (array $data, Component $livewire) {
                        $fund = $this->getOwnerRecord();
                        $lot = new Lot($data);
                        $lot->fund_id = $fund->id;
                        $lot->ref = uniqid('temp');
                        $lot->save();
                        $lot->ref = "$fund->ref/$lot->id";
                        $lot->save();
                        $livewire->redirect(LotResource::getUrl('view', ['record' => $lot]));
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

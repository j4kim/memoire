<?php

namespace App\Filament\Resources\Funds\RelationManagers;

use App\Filament\Helpers;
use App\Filament\Resources\People\PersonResource;
use App\Models\Person;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';
    protected static ?string $title = 'Personnes liées à ce fond';
    protected static ?string $modelLabel = 'personne';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                ...Helpers::systemColumns(),
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('role')->label("Rôle"),
            ])
            ->headerActions([
                AttachAction::make()->schema(fn(AttachAction $action): array => [
                    $action->getRecordSelect(),
                    Helpers::roleSelect(),
                ]),
                CreateAction::make()->schema([
                    Grid::make(2)->components([
                        TextInput::make('first_name'),
                        TextInput::make('last_name'),
                        Helpers::roleSelect()->columnSpanFull(),
                    ]),
                ])->modalWidth(Width::Large),
            ])
            ->recordActions([
                DetachAction::make(),
                EditAction::make()->schema([
                    Helpers::roleSelect(),
                ])->modalWidth(Width::Large),
                ViewAction::make()->url(function (Person $person) {
                    return PersonResource::getUrl('view', ['record' => $person]);
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}

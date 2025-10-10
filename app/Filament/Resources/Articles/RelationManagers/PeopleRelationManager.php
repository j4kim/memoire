<?php

namespace App\Filament\Resources\Articles\RelationManagers;

use App\Filament\Helpers;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';
    protected static ?string $title = 'Personnes liées à cet objet';
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
                    TextInput::make('role'),
                ]),
                CreateAction::make()->schema([
                    TextInput::make('first_name'),
                    TextInput::make('last_name'),
                    TextInput::make('role'),
                ]),
            ])
            ->recordActions([
                DetachAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}

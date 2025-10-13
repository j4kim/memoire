<?php

namespace App\Filament\Resources\Funds;

use App\Filament\Resources\Funds\Pages\CreateFund;
use App\Filament\Resources\Funds\Pages\EditFund;
use App\Filament\Resources\Funds\Pages\ListFunds;
use App\Filament\Resources\Funds\Pages\ViewFund;
use App\Filament\Resources\Funds\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\Funds\RelationManagers\LotsRelationManager;
use App\Filament\Resources\Funds\RelationManagers\PeopleRelationManager;
use App\Filament\Resources\Funds\Schemas\FundForm;
use App\Filament\Resources\Funds\Schemas\FundInfolist;
use App\Filament\Resources\Funds\Tables\FundsTable;
use App\Models\Fund;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FundResource extends Resource
{
    protected static ?string $model = Fund::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Inventaire';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = 'fond';
    protected static ?string $pluralModelLabel = 'fonds';

    public static function form(Schema $schema): Schema
    {
        return FundForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FundInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FundsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            LotsRelationManager::class,
            ArticlesRelationManager::class,
            PeopleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFunds::route('/'),
            'create' => CreateFund::route('/create'),
            'view' => ViewFund::route('/{record}'),
            'edit' => EditFund::route('/{record}/edit'),
        ];
    }
}

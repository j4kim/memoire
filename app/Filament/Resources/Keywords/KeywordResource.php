<?php

namespace App\Filament\Resources\Keywords;

use App\Filament\Resources\Keywords\Pages\CreateKeyword;
use App\Filament\Resources\Keywords\Pages\EditKeyword;
use App\Filament\Resources\Keywords\Pages\ListKeywords;
use App\Filament\Resources\Keywords\Pages\ViewKeyword;
use App\Filament\Resources\Keywords\Schemas\KeywordForm;
use App\Filament\Resources\Keywords\Schemas\KeywordInfolist;
use App\Filament\Resources\Keywords\Tables\KeywordsTable;
use App\Models\Keyword;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KeywordResource extends Resource
{
    protected static ?string $model = Keyword::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'Administration';
    protected static ?int $navigationSort = 11;
    protected static ?string $recordTitleAttribute = 'fr';
    protected static ?string $modelLabel = 'mot-matière';
    protected static ?string $pluralModelLabel = 'mots-matière';

    public static function form(Schema $schema): Schema
    {
        return KeywordForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KeywordInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KeywordsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKeywords::route('/'),
            'create' => CreateKeyword::route('/create'),
            'view' => ViewKeyword::route('/{record}'),
            'edit' => EditKeyword::route('/{record}/edit'),
        ];
    }
}

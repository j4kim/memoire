<?php

namespace App\Filament\Resources\Keywords\Schemas;

use App\Filament\Helpers;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KeywordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Traductions')->schema([
                    TextEntry::make('fr'),
                    TextEntry::make('de'),
                    TextEntry::make('en'),
                ])->columns(4),

                Helpers::systemSection(),
            ])->columns(1);
    }
}

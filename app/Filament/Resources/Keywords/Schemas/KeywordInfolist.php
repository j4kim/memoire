<?php

namespace App\Filament\Resources\Keywords\Schemas;

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

                Section::make('Système')->schema([
                    TextEntry::make('id')->label("ID"),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
                ])->columns(4)->collapsible()->persistCollapsed(),
            ])->columns(1);
    }
}

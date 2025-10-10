<?php

namespace App\Filament\Resources\People\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coordonnées')->schema([
                    TextEntry::make('first_name'),
                    TextEntry::make('last_name'),
                    TextEntry::make('birth_year')->numeric(),
                    TextEntry::make('death_year')->numeric(),
                    TextEntry::make('description')->columnSpan(2),
                    TextEntry::make('address')->columnSpan(2),
                    TextEntry::make('postal_code'),
                    TextEntry::make('locality'),
                    TextEntry::make('country'),
                    TextEntry::make('phone'),
                    TextEntry::make('email'),
                    TextEntry::make('position'),
                ])->columns(4),

                Section::make('Système')->schema([
                    TextEntry::make('id')->label("ID"),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
                ])->columns(4)->collapsible()->persistCollapsed(),
            ])->columns(1);
    }
}

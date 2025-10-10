<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Filament\Helpers;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Classification')->schema([
                    TextEntry::make('name')
                ]),

                Helpers::systemSection(),
            ])->columns(1);
    }
}

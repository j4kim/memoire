<?php

namespace App\Filament;

use Filament\Forms\Components\Field;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;

class Helpers
{
    public static function systemColumns(): array
    {
        return [
            TextColumn::make('id')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->dateTime("d.m.Y H:i")
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->dateTime("d.m.Y H:i")
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function systemSection(): Section
    {
        return Section::make('Système')->schema([
            TextEntry::make('id'),
            TextEntry::make('created_at')->isoDate('LLL')->label("Date de saisie"),
            TextEntry::make('updated_at')->isoDate('LLL')->label("Date de modification"),
        ])->columns(4)->collapsible()->persistCollapsed();
    }

    public static function refColumn(): TextColumn
    {
        return TextColumn::make('ref')
            ->sortable()
            ->toggleable()
            ->searchable();
    }

    public static function setLabel(TextColumn|TextEntry|Field $component): void
    {
        $name = $component->getName();
        $tr = __($name);
        if ($tr != $name) {
            $component->label($tr);
        }
    }
}

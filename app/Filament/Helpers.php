<?php

namespace App\Filament;

use Filament\Tables\Columns\TextColumn;

class Helpers
{
    public static function systemColumns(): array
    {
        return [
            TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->dateTime("d.m.Y H:i")
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label("Saisi le"),
            TextColumn::make('updated_at')
                ->dateTime("d.m.Y H:i")
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label("Modifié le"),
        ];
    }
}

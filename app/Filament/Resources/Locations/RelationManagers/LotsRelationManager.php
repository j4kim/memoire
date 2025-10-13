<?php

namespace App\Filament\Resources\Locations\RelationManagers;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Lots\LotResource;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class LotsRelationManager extends RelationManager
{
    protected static string $relationship = 'lots';
    protected static ?string $title = 'Lots liés à ce lieu';

    protected static ?string $relatedResource = LotResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function getTabComponent(Model $ownerRecord, string $pageClass): Tab
    {
        return Tab::make('Lots')->badge($ownerRecord->lots()->count());
    }
}

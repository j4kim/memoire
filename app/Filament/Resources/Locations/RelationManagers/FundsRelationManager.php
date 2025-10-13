<?php

namespace App\Filament\Resources\Locations\RelationManagers;

use App\Filament\Resources\Funds\FundResource;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FundsRelationManager extends RelationManager
{
    protected static string $relationship = 'funds';
    protected static ?string $title = 'Fonds liés à ce lieu';

    protected static ?string $relatedResource = FundResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function getTabComponent(Model $ownerRecord, string $pageClass): Tab
    {
        return Tab::make('Fonds')->badge($ownerRecord->funds()->count());
    }
}

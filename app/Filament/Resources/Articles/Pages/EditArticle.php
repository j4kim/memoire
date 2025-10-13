<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\Actions\Replicate;
use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            ActionGroup::make([
                DeleteAction::make(),
                Replicate::make(),
            ]),
        ];
    }
}

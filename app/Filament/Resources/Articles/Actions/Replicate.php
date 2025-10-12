<?php

namespace App\Filament\Resources\Articles\Actions;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Livewire\Component;


class Replicate extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'article-replicate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label("Dupliquer");

        $this->icon(Heroicon::Square2Stack);

        $this->requiresConfirmation();

        $this->action(function (array $data, Component $livewire, Article $record): void {
            $replica = $record->replicate();
            $replica->ref = $replica->ref . ' (copie)';
            $replica->save();
            $livewire->redirect(
                ArticleResource::getUrl('edit', ['record' => $replica])
            );
        });
    }
}

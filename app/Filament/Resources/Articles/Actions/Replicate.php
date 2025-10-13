<?php

namespace App\Filament\Resources\Articles\Actions;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\Width;
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
        $this->modalWidth(Width::Large);

        $this->schema([
            TextInput::make('title')->default(fn(Article $record) => $record->title),
        ]);

        $this->action(function (array $data, Component $livewire, Article $record): void {
            $replica = $record->replicate();
            $replica->fill($data);
            $replica->ref = $record->getNextRef();
            $replica->save();
            $livewire->redirect(
                ArticleResource::getUrl('view', ['record' => $replica])
            );
        });
    }
}

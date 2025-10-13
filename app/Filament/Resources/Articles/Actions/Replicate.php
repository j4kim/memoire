<?php

namespace App\Filament\Resources\Articles\Actions;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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
            Checkbox::make('copy_locations')->label("Copier les lieux"),
        ]);

        $this->action(function (array $data, Component $livewire, Article $record): void {
            $replica = $record->replicate();
            $replica->title = $data['title'];
            $replica->ref = $record->getNextRef();
            $replica->save();
            if ($data['copy_locations']) {
                $replica->locations()->attach($record->locations()->pluck('id'));
            }
            $livewire->redirect(
                ArticleResource::getUrl('view', ['record' => $replica])
            );
            Notification::make()
                ->title("Objet dupliqué")
                ->body("Vous avez été redirigé sur le nouvel objet")
                ->success()
                ->send();
        });
    }
}

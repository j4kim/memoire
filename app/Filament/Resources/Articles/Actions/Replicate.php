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
            Checkbox::make('copy_keywords')->label("Copier les mots-matière"),
            Checkbox::make('copy_people')->label("Copier les personnes"),
            Checkbox::make('copy_attachments')->label("Copier les médias"),
        ]);

        $this->action(function (array $data, Component $livewire, Article $record): void {
            $replica = $record->replicate();
            $replica->title = $data['title'];
            $replica->ref = $record->getNextRef();
            $replica->save();
            if ($data['copy_locations']) {
                $replica->locations()->attach($record->locations()->pluck('id'));
            }
            if ($data['copy_keywords']) {
                $replica->keywords()->attach($record->keywords()->pluck('id'));
            }
            if ($data['copy_people']) {
                $replica->people()->attach(
                    $record->people()->pluck("role", "id")->map(fn($role) => ['role' => $role])
                );
            }
            if ($data['copy_attachments']) {
                $replica->attachments()->attach($record->attachments()->pluck('id'));
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

<?php

namespace App\Filament\Resources\Articles\Actions;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\ReplicateAction;

class Replicate extends ReplicateAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label("Dupliquer");

        $this->excludeAttributes(['id']);

        $this->mutateRecordDataUsing(function (array $data): array {
            $data['ref'] = $data['ref'] . ' (copie)';
            return $data;
        });

        $this->successRedirectUrl(function (Article $replica) {
            return ArticleResource::getUrl('edit', ['record' => $replica]);
        });
    }
}

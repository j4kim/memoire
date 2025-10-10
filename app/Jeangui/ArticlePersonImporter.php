<?php

namespace App\Jeangui;

use App\Jeangui\Models\Document;
use App\Models\Keyword;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class ArticlePersonImporter
{
    public static function import()
    {
        $allIds = Person::pluck('id');
        $docs = Document::where('ids_auteur', '!=', ';;;;;;;;;')->get();

        foreach ($docs as $doc) {
            $ids = str($doc->ids_auteur)
                ->explode(';')
                ->unique()
                ->filter();
            foreach ($ids as $id) {
                if ($allIds->doesntContain($id)) {
                    echo "Person $id not found for article $doc->id\n";
                    continue;
                }
                DB::table('article_person')->insert([
                    'article_id' => $doc->id,
                    'person_id' => $id,
                ]);
            }
        }
    }
}

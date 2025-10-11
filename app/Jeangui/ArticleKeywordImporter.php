<?php

namespace App\Jeangui;

use App\Jeangui\Models\Document;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;

class ArticleKeywordImporter
{
    public static function import()
    {
        $allKeywordIds = Keyword::pluck('id');
        $docs = Document::where('ids_motmatiere', '!=', ';;;;;;;;;')->get();

        foreach ($docs as $doc) {
            $keywordIds = str($doc->ids_motmatiere)
                ->explode(';')
                ->unique()
                ->filter();
            foreach ($keywordIds as $keywordId) {
                if ($allKeywordIds->doesntContain($keywordId)) {
                    echo "Keyword $keywordId not found for article $doc->id\n";
                    continue;
                }
                DB::table('article_keyword')->insert([
                    'article_id' => $doc->id,
                    'keyword_id' => $keywordId,
                ]);
            }
        }
    }
}

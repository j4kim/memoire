<?php

namespace App\Jeangui;

use App\Jeangui\Models\Document;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class ArticleLocationImporter
{
    public static function import()
    {
        $allLocationIds = Location::pluck('id');
        $docs = Document::where('ids_lieu', '!=', ';;;;;;;;;')->get();

        foreach ($docs as $doc) {
            $locationIds = str($doc->ids_lieu)
                ->explode(';')
                ->unique()
                ->filter();
            foreach ($locationIds as $locationId) {
                if ($allLocationIds->doesntContain($locationId)) {
                    echo "Location $locationId not found for article $doc->id\n";
                    continue;
                }
                DB::table('article_location')->insert([
                    'article_id' => $doc->id,
                    'location_id' => $locationId
                ]);
            }
        }
    }
}

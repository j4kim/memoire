<?php

namespace App\Jeangui\Models;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $connection = 'jeangui';

    public static function import()
    {
        foreach (self::orderBy('id')->get() as $doc) {
            Article::create([
                'id' => $doc->id,
                'lot_id' => $doc->id_lot,
                'category_id' => str($doc->type)->before("\t"),
                'title' => $doc->titre ?: null,
                'ref' => $doc->cote,
                'description' => $doc->description ?: null,
                'date' => $doc->date_precise ? Carbon::createFromFormat("d.m.Y", $doc->date_precise)->format("Y-m-d") : null,
                'subtitle' => $doc->titre_alternatif ?: null,
                'year_from' => $doc->date_approx_de,
                'year_to' => $doc->date_approx_a,
                'collation' => $doc->collation ?: null,
                'state' => $doc->etat,
                'language' => $doc->langue ?: null,
                'legacy' => [
                    'jeangui' => [
                        'location' => $doc->localisation,
                        'storage' => $doc->rangement,
                        'life_of_document' => $doc->vie_du_document,
                        'dimensions' => $doc->dimensions,
                        'keyword_ids' => $doc->ids_motmatiere,
                        'author_ids' => $doc->ids_auteur,
                        'doc_nr' => $doc->num_doc,
                        'old_ref' => $doc->ancienne_cote,
                        'availability' => $doc->accessibilite,
                    ],
                ],
                'created_at' => $doc->date_de_saisie ? Carbon::createFromFormat("d.m.Y", $doc->date_de_saisie)->format("Y-m-d") : null,
                'updated_at' => $doc->date_de_modification ? Carbon::createFromFormat("d.m.Y", $doc->date_de_modification)->format("Y-m-d") : null,
            ]);
        }
    }
}

<?php

namespace App\Jeangui;

use App\Jeangui\Models\Document;
use App\Jeangui\Models\Fond;
use App\Jeangui\Models\Lieu;
use App\Jeangui\Models\Lot;
use App\Jeangui\Models\Motmatiere;
use App\Jeangui\Models\Personne;

class Importer
{
    public static function run()
    {
        Lieu::import();
        Motmatiere::import();
        Personne::import();
        Fond::import();
        Lot::import();
        Document::import();
    }
}
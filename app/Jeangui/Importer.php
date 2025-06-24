<?php

namespace App\Jeangui;

use App\Jeangui\Models\Lieu;
use App\Jeangui\Models\Motmatiere;

class Importer
{
    public static function run()
    {
        Lieu::import();
        Motmatiere::import();
    }
}
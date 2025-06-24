<?php

namespace App\Jeangui;

use App\Jeangui\Models\Lieu;

class Importer
{
    public static function run()
    {
        Lieu::import();
    }
}
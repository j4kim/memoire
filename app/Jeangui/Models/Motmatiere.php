<?php

namespace App\Jeangui\Models;

use App\Models\Keyword;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Motmatiere extends Model
{
    protected $table = 'motmatiere';
    protected $connection = 'jeangui';

    public static function import()
    {
        foreach (self::orderBy('id')->get() as $motmat) {
            $parts = explode(';', $motmat->traductions);
            Keyword::create([
                'id' => $motmat->id,
                'fr' => @$parts[0],
                'de' => @$parts[1],
                'en' => @$parts[2],
            ]);
        }
    }
}
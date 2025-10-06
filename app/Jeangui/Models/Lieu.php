<?php

namespace App\Jeangui\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $table = 'lieux';
    protected $connection = 'jeangui';

    public static function import()
    {
        foreach (self::orderBy('id')->get() as $lieu) {
            Location::create([
                'id' => $lieu->id,
                'name' => $lieu->nom,
            ]);
        }
    }
}
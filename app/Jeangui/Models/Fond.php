<?php

namespace App\Jeangui\Models;

use App\Models\Fund;
use Illuminate\Database\Eloquent\Model;

class Fond extends Model
{
    protected $connection = 'jeangui';

    public static function import()
    {
        foreach (self::orderBy('id')->get() as $fond) {
            Fund::create([
                'id' => $fond->id,
                'name' => $fond->nom,
                'ref' => $fond->cote,
                'description' => $fond->description,
            ]);
        }
    }
}
<?php

namespace App\Jeangui\Models;

use App\Models\Fund;
use App\Models\Lot as AppLot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $connection = 'jeangui';

    public static function import()
    {
        $funds = Fund::all();
        foreach (self::orderBy('id')->get() as $lot) {
            $fund = $funds->firstWhere('id', $lot->id_fond);
            if (!$fund) {
                echo "No fund found for lot $lot->id\n";
            }
            AppLot::create([
                'id' => $lot->id,
                'fund_id' => $fund->id,
                'name' => $lot->nom,
                'ref' => $fund->ref . '/' . $lot->id,
                'description' => $lot->description ?: null,
                'date' => $lot->date ? Carbon::createFromFormat("d.m.Y", $lot->date)->format("Y-m-d") : null,
                'price' => $lot->prix ?: null,
            ]);
        }
    }
}
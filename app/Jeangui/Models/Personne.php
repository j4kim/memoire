<?php

namespace App\Jeangui\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    protected $connection = 'jeangui';

    public static function import()
    {
        foreach (self::orderBy('id')->get() as $personne) {
            Person::create([
                'id' => $personne->id,
                'first_name' => $personne->nom4 ?: null,
                'last_name' => $personne->nom3 ?: null,
                'birth_year' => $personne->naissance,
                'death_year' => $personne->deces,
                'description' => $personne->description,
                'address' => $personne->adresse,
                'postal_code' => $personne->npa,
                'locality' => $personne->localite ?: null,
                'country' => $personne->pays ?: null,
                'phone' => $personne->telephone ?: null,
                'email' => $personne->email ?: null,
            ]);
        }
    }
}
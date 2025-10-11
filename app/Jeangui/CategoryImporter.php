<?php

namespace App\Jeangui;

use App\Jeangui\Models\Document;
use App\Models\Category;

class CategoryImporter
{
    public static function import()
    {
        $types = Document::select('type')->groupBy('type')->pluck('type');
        foreach ($types as $type) {
            [$id, $name] = str($type)->split("/\t\s*/")->toArray();
            Category::create(compact('id', 'name'));
        }
    }
}

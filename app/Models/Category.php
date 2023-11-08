<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'maxLength' => 190,
                'unique' => true
            ]
        ];
    }


}

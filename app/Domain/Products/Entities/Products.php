<?php

namespace App\Domain\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'category_id',
        'image_url'
    ];
}

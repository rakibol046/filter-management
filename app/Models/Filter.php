<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
   protected $fillable = [
    'user_id',
    'name',
    'brand',
    'model',
    'description',
    'status',
];
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}
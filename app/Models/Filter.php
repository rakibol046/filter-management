<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Filter extends Model
{
    use SoftDeletes;

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
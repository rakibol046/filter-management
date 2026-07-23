<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
     protected $fillable = [
    'filter_id',
    'user_id',
    'name',
    'brand',
    'kit_lifespan_days',

];
    public function filter()
        {
            return $this->belongsTo(Filter::class);
        }
    public function user()
        {
            return $this->belongsTo(User::class);
        }
}

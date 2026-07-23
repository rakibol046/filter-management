<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeHistory extends Model
{
    protected $fillable = [
        'user_id',
        'filter_id',
        'kit_id',
        'change_date',
        'next_change_date',
        'status',
    ];

     /**
     * The user who changed the kit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The filter associated with this change.
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    /**
     * The kit that was changed.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }
}

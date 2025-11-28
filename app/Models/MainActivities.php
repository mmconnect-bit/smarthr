<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainActivities extends Model
{
    protected $fillable = [
        'name',
        'payment_amount',
        'is_per_day',
        'created_by',
    ];

    public function activities()
    {
        return $this->hasMany('App\Models\Activities', 'id', 'main_activity_id');
    }

}

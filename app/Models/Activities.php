<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $fillable = [
        'name',
        'main_activity_id',
        'created_by',
    ];

    public function activities()
    {
        return $this->belongsTo('App\Models\MainActivities','main_activity_id','id');
    }
}

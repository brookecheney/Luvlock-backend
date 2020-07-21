<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'latitude', 'longitude','date_locked', 'lock_image_url', 'message','status',
    ];

}

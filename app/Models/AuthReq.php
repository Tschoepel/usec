<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthReq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'valid_until'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

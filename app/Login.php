<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $table = 'login';

    protected $fillable = [
        'uid',
        'password'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }
}

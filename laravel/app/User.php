<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if(Auth::user()->level > 1)
            return true;
    }

    public function isComposer()
    {
        if(Auth::user()->level > 0)
            return true;
    }

    public function stories()
    {
        return $this->hasMany('App\Story');
    }
}

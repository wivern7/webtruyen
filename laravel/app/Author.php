<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table     = 'authors';
    protected $fillable  = ['name', 'alias', 'keyword', 'description'];
    //public $timestamps   = false;

    public function stories()
    {
        return $this->belongsToMany('App\Story', 'story_authors');
    }
}

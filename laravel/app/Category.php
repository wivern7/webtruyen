<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table     = 'categories';
    protected $fillable  = ['name', 'alias', 'parent_id', 'keyword', 'description'];
    //public $timestamps   = false;

    public function stories()
    {
        return $this->belongsToMany('App\Story', 'story_categories');
    }
}

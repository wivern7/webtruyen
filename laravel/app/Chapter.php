<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table     = 'chapters';
    protected $fillable  = ['name', 'subname', 'alias', 'content', 'view', 'story_id', 'keyword', 'description'];
    //public $timestamps   = false;

    public function story()
    {
        return $this->belongsTo('App\Story');
    }


    public function theNextSubname($id)
    {
        $count = $this->where('story_id', $id)->count() + 1;
        return 'Chương ' . $count;
    }

}

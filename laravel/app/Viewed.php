<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class Viewed extends Model
{
  protected $table     = 'viewed';

  public function story()
  {
      return $this->belongsTo('App\Story');
  }

  public function chapter()
  {
      return $this->belongsTo('App\Chapter');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function getListReading()
  {
      if (Auth::user()) {
        $data = self::where('user_id', Auth::user()->id)->get();
      } else {
        $data = Session::get('viewed');
        $data = (!is_null($data)) ? array_reverse($data) : null;
      }

      return $data;
  }

  public function addToListReading($story, $chapter)
  {
    if (Auth::user()) {
      $data = self::where([['user_id', Auth::user()->id],['story_id', $story]]);
      if ($data) {
        $data->delete();
      }
      $viewed = new Viewed;
      $viewed->story_id = $story;
      $viewed->chapter_id = $chapter;
      $viewed->user_id = Auth::user()->id;
      $viewed->save();
    } else {
      $data = Session::get('viewed');
      $count = count($data);
      if($data > 0) foreach($data as $key=>$item)
      {
        if($item['story_id'] == $story)
          Session::forget('viewed.' . $key);
      }
      Session::push('viewed',['story_id' => $story, 'chapter_id' => $chapter,'created_at' => time()]);
    }

    $this->removeListReading();
  }

  public function removeListReading()
  {
    if (Auth::user()) {
      $data = self::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
      $t=1;
      foreach ($data as $item) {
        if($t > 5) self::where('id', $item->id)->delete();
        $t++;
      }

    } else {
      $data = Session::get('viewed');
      $count = count($data);
      if($count > 5)
      for ($i= 1; $i<= ($count-5); $i++) Session::forget('viewed.' . $i);
    }
  }
}

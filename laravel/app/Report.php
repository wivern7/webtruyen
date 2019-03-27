<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $table     = 'reports';

  public function chapter()
  {
      return $this->belongsTo('App\Chapter');
  }

  static public function getCount()
  {
      $count = self::count();
      return $count;
  }

  static public function getListReportNotSolved()
  {
    $result = self::take(5)->get();
    return $result;
  }

}

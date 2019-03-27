<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table     = 'options';
    protected $fillable  = ['name', 'value'];
    //public $timestamps   = false;

    public static function getvalue($name)
    {
        $option = self::select('value')->where('name',$name)->first();
        if($option)
            return $option->value;
        else
            return false;
    }

    public static function put($name, $value)
    {
        $option = self::where('name',$name)->first();
        if($option)
        {
            $option->value = $value;
            $option->save();
        }
        else
            return false;
    }

    public static function add($name, $value)
    {
        return self::create(['name'=>$name, 'value'=>$value]);
    }

    public static function del($name)
    {
        $option = self::where('name',$name)->first();
        if($option) $option->delete();
    }
}

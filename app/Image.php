<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public function subs(){
      return $this->hasMany('App\Image');
  }
}

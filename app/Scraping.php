<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Scraping extends Model
{
  protected $fillable = [
      'content'
  ];

  public function sub(){
      return $this->hasMany('App\Image');
  }
}

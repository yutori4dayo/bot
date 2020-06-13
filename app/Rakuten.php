<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rakuten extends Model
{
  protected $fillable = [
      'name',
      'image',
      'url',
      'price'
  ];
}

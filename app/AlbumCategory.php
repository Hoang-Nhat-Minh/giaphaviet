<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
  protected $guarded = [];

  public function images()
  {
    return $this->hasMany(AlbumImage::class);
  }
}


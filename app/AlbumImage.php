<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
  public function category()
  {
    return $this->belongsTo(AlbumCategory::class);
  }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Libary extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

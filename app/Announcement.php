<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Announcement extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

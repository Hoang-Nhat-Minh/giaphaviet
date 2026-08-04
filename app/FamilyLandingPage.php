<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
// use TCG\Voyager\Traits\Translatable;

class FamilyLandingPage extends Model
{
  // use Translatable;
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

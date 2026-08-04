<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AccessTime extends Model
{
  protected $fillable = [
    'access_user_id',
    'last_seen'
  ];

  public $timestamps = false;

  public function access_users()
  {
    return $this->belongsTo(AccessUser::class, 'access_user_id');
  }
}

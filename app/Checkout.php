<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Checkout extends Model
{
  protected $guarded = [];

  public function service()
  {
    return $this->belongsTo(Service::class, 'id', 'service_id');
  }
}

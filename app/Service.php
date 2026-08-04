<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use TCG\Voyager\Traits\Resizable;
// use App\Cart;

class Service extends Model
{
  use Translatable;
  use Resizable;

  protected $translatable = ['title', 'description', 'content'];

  // public function cart()
  // {
  //   return $this->belongsTo(Cart::class);
  // }
}

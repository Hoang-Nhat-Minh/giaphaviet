<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Lineage;
use App\Libary;
use App\Document;
use App\FamilyLandingPage;
use App\AlbumCategory;

class User extends \TCG\Voyager\Models\User
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function lineage()
  {
    return $this->belongsTo(Lineage::class);
  }

  public function libary()
  {
    return $this->hasMany(Libary::class);
  }

  public function document()
  {
    return $this->hasMany(Document::class);
  }

  public function announcement()
  {
    return $this->hasMany(Document::class);
  }

  public function familyHome()
  {
    return $this->hasMany(FamilyLandingPage::class);
  }
  // public function cart()
  // {
  //   return $this->hasMany(Cart::class);
  // }

  public function album_category()
  {
    return $this->hasMany(AlbumCategory::class);
  }
}

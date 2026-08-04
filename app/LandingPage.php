<?php

namespace App;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;


class LandingPage extends Model
{
  use Translatable;
  protected $translatable = [
    'banner_text',
    'banner_subtext',
    'about_content',
    'blog_header',
    'blog_subheader',
    'location',
    'demo_content',
    'demo_header'
  ];
}

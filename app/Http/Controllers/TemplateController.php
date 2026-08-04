<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
  /**
   * Return the single default layout for all family tree screens: imperial-dragon
   */
  public static function checkTemplate()
  {
    return 'imperial-dragon';
  }
}

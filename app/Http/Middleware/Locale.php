<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Locale
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    // Get the language from the session or fallback to the default
    $language = \Session::get('website_language', config('app.locale'));

    // Set the application's locale dynamically
    App::setLocale($language);

    return $next($request);
  }
}
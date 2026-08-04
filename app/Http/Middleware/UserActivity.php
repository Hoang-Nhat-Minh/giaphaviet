<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use App\AccessUser;
use App\AccessTime;

class UserActivity
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
      if (array_key_exists($key, $_SERVER) === true) {
        foreach (explode(',', $_SERVER[$key]) as $ip) {
          $ip = trim($ip); // just to be safe
          if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */

            // Cache::put($ip, true, $expiresAt);

            /* last seen */
            $access_user = AccessUser::firstOrCreate([
              'ip' => $ip
            ]);

            $access_time = AccessTime::where('access_user_id', $access_user->id)
              ->where('last_seen', '>=', now()->subMinutes(2))->first();

            if (!$access_time) {
              AccessTime::create([
                'access_user_id' => $access_user->id,
                'last_seen' => now()->subMinutes(2)
              ]);
            } else {
              $access_time->update(['last_seen' => now()]);
            }
          }
        }
      }
    }

    return $next($request);
  }
}

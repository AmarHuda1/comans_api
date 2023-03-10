<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Token;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish User to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $tBearer = $request->bearerToken();
            $token = $request->header('token');
            if ($token) {
                $id = Token::where('token', '=', $token)->first();
                if ($id) {
                    return User::where('user_id', $id->user_id)->first();
                }
            }
            if ($tBearer) {
                $id = Token::where('token', '=', $tBearer)->first();
                if ($id) {
                    return User::where('user_id', $id->user_id)->first();
                }
            }
        });
    }
}

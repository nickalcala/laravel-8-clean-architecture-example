<?php

namespace App\Providers\OAuth;

use Dingo\Api\Auth\Auth;
use Dingo\Api\Exception\Handler;
use Dingo\Api\Transformer\Adapter\Fractal;
use Dingo\Api\Transformer\Factory;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\CreatesUserProviders;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class OAuthServiceProvider extends ServiceProvider
{

    use CreatesUserProviders;

    public function register()
    {
    }

    public function boot()
    {
        Passport::routes();
        Passport::tokensCan([
            'product.read' => 'Read Posts',
            'product.write' => 'Write Posts',
        ]);

        if (file_exists(Passport::keyPath('oauth-private.key')) &&
            file_exists(Passport::keyPath('oauth-public.key'))) {
            $oauthProvider = $this->app->make(OAuth::class);
            $oauthProvider->setUserProvider($this->createUserProvider(config('auth.guards.api.provider')));
            $this->app[Auth::class]->extend('oauth', $oauthProvider);

            $this->app[Factory::class]->setAdapter(function ($app) {
                $fractal = new Manager;
                $fractal->setSerializer(new JsonApiSerializer);
                return new Fractal($fractal);
            });
        }

        $this->app->make(Handler::class)->register(function (AuthenticationException $e) {
            return response('Unauthorized', 401);
        });
    }
}

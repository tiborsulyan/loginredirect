<?php

namespace Tiborsulyan\LoginRedirect;

use Flarum\Foundation\AbstractServiceProvider;
use Laminas\Stratigility\MiddlewarePipe;

class AddExecuteRouteMiddleware extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->singleton('flarum.forum.handler', function () {
            $pipe = new MiddlewarePipe;

            foreach ($this->app->make('flarum.forum.middleware') as $middleware) {
                $pipe->pipe($this->app->make($middleware));
            }

            $pipe->pipe(new ExecuteRoute());

            return $pipe;
        });
    }
}
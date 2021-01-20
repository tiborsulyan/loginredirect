<?php

namespace Tiborsulyan\LoginRedirect;

use Flarum\Http\Exception\RouteNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class ExecuteRoute implements Middleware
{
    /**
     * Executes the route handler resolved in ResolveRoute.
     */
    public function process(Request $request, Handler $handler): Response
    {
        if ($this->isUserView($request) && $this->unauthenticated($request)) {
            return $this->loginRedirect($request);
        }

        try {
            $handler = $request->getAttribute('routeHandler');
            $parameters = $request->getAttribute('routeParameters');
            return $handler($request, $parameters);
        } catch (RouteNotFoundException | ModelNotFoundException $e) {
            if ($this->unauthenticated($request)) {
                return $this->loginRedirect($request);
            } else {
                throw $e;
            }
        }
    }

    private function unauthenticated(Request $request): bool
    {
        return $request->getAttribute('actor')->isGuest();
    }

    private function loginRedirect(Request $request): Response
    {
        $uri = $request->getUri()->getPath() ?: '/';
        return new RedirectResponse('/?notfound=1&dest=' . urlencode($uri));
    }

    private function isUserView(Request $request): bool
    {
        return substr($request->getUri()->getPath(), 0, 3) == '/u/';
    }

}

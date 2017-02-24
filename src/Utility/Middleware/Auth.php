<?php
namespace Previewtechs\Framework\PHP\SlimSkeleton\Utility\Middleware;

class Auth
{
    public function __invoke($request, $response, $next)
    {
        return $next($request, $response);
    }
}
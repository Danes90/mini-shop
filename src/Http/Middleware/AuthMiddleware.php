<?php

namespace App\Http\Middleware;

use App\Infrastructure\Session\SessionManager;

class AuthMiddleware
{
    private SessionManager $session;
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function handle(callable $next)
    {
        if (!$this->session->has('user')) {
            die('Unauthorized');
        }

        return $next();
    }
}
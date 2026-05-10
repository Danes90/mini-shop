<?php

namespace App\Infrastructure\Session;

class SessionManager
{
    /**
     * set session key with value
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * get session value by key
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * session key check
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * destron session
     * @return void
     */
    public function destroy(): void
    {
        session_destroy();
    }
}
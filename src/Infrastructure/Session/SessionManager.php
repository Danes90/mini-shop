<?php

namespace App\Infrastructure\Session;

class SessionManager
{
    /**
     * Summary of set
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Summary of get
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Summary of has
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Summary of destroy
     * @return void
     */
    public function destroy(): void
    {
        session_destroy();
    }
}
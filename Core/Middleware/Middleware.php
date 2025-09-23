<?php

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key['middleware']] ?? false;

        if (!$middleware) {
            throw new Exception("No matching middleware found for '{$key}'");
        }

        (new $middleware)->handle();
    }
}
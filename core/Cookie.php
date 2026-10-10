<?php

class Cookie
{
    const DEFAULT_LIFETIME = 86400 * 30;

    public static function set(string $name, string $value, int $lifetime = self::DEFAULT_LIFETIME, string $path = '/'): void
    {
        setcookie($name, $value, time() + $lifetime, $path);
        $_COOKIE[$name] = $value;
    }

    public static function get(string $name, string $default = ''): string
    {
        return isset($_COOKIE[$name]) ? (string)$_COOKIE[$name] : $default;
    }

    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    public static function delete(string $name, string $path = '/'): void
    {
        setcookie($name, '', time() - 3600, $path);
        unset($_COOKIE[$name]);
    }
}

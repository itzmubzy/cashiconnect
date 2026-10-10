<?php

class Auth
{
    private static bool $started = false;

    public static function start(): void
    {
        if (!self::$started && session_status() === PHP_SESSION_NONE) {
            session_start();
            self::$started = true;
        } elseif (session_status() === PHP_SESSION_ACTIVE) {
            self::$started = true;
        }
    }

    public static function requireRole($role, string $loginUrl = ''): void
    {
        self::start();

        $allowed = is_array($role) ? $role : [$role];

        if (!self::isLoggedIn() || !in_array($_SESSION['role'] ?? '', $allowed, true)) {
            if ($loginUrl === '') {
                $depth = substr_count(str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']), '/cashiconnect/') - 1;
                $prefix = str_repeat('../', max(0, $depth));
                $loginUrl = $prefix . 'login.php';
            }
            header("Location: $loginUrl");
            exit();
        }
    }

    public static function isLoggedIn(): bool
    {
        self::start();
        return isset($_SESSION['id'], $_SESSION['role']);
    }

    public static function userId(): int
    {
        self::start();
        return (int)($_SESSION['id'] ?? 0);
    }

    public static function username(): string
    {
        self::start();
        return (string)($_SESSION['username'] ?? '');
    }

    public static function role(): string
    {
        self::start();
        return (string)($_SESSION['role'] ?? '');
    }

    public static function login(int $userId, string $username, string $role): void
    {
        self::start();
        session_regenerate_id(true);
        $_SESSION['id']       = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['role']     = $role;
    }

    public static function logout(): void
    {
        self::start();
        session_destroy();
    }
}

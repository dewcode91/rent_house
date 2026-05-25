<?php
/**
 * Authentication Middleware
 */

class Auth
{
    public static function check()
    {
        return isset($_SESSION['user_id']);
    }

    public static function user()
    {
        if (self::check()) {
            return $_SESSION['user'];
        }
        return null;
    }

    public static function id()
    {
        if (self::check()) {
            return $_SESSION['user_id'];
        }
        return null;
    }

    public static function role()
    {
        if (self::check()) {
            return $_SESSION['user']['role'];
        }
        return null;
    }

    public static function login($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $user;
        $_SESSION['last_activity'] = time();
    }

    public static function logout()
    {
        session_destroy();
    }

    public static function isAdmin()
    {
        return self::role() === 'admin';
    }

    public static function isOwner()
    {
        return self::role() === 'owner';
    }

    public static function isTenant()
    {
        return self::role() === 'tenant';
    }

    public static function isAuthenticated($role = null)
    {
        if (!self::check()) {
            return false;
        }
        if ($role && self::role() !== $role) {
            return false;
        }
        return true;
    }

    public static function checkSessionTimeout()
    {
        if (isset($_SESSION['last_activity'])) {
            $timeout = SESSION_TIMEOUT * 60;
            if ((time() - $_SESSION['last_activity']) > $timeout) {
                self::logout();
                return false;
            }
        }
        $_SESSION['last_activity'] = time();
        return true;
    }

    public static function requireLogin()
    {
        if (!self::check()) {
            header('Location: ' . SITE_URL . '/login');
            exit;
        }
    }

    public static function requireAdmin()
    {
        if (!self::isAdmin()) {
            header('Location: ' . SITE_URL . '/');
            exit;
        }
    }

    public static function requireOwner()
    {
        if (!self::isOwner()) {
            header('Location: ' . SITE_URL . '/');
            exit;
        }
    }

    public static function requireTenant()
    {
        if (!self::isTenant()) {
            header('Location: ' . SITE_URL . '/');
            exit;
        }
    }
}

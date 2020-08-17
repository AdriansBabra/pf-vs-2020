<?php

declare(strict_types=1);

namespace Project\Components;


class Session
{
    public const KEY_USER_ID = 'user_id';

    private static ?Session $instance = null;

    public const KEY_CSRF = 'csrf';

    public static function getInstance(): Session
    {
        if (!self::$instance) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function regenerate(): void
    {
        session_regenerate_id();
    }

    public function destroy(): void
    {
        session_destroy();
    }

    /**
     * Generate CSFR token if it does not exist
     */
    public function generateCsrf(): void
    {
        if($this->get(self::KEY_CSRF)) {
            return;
        }

        $token = md5((string)rand(0,1000000));

        $this->set(self::KEY_CSRF, $token);
    }

    public function getCsrf(): string
    {
        return $this->get(self::KEY_CSRF, '');
    }
}
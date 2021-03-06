<?php

declare(strict_types=1);

namespace Project\Components;


class Session
{
    public const KEY_USER_ID = 'user_id';

    private static ?Session $instance = null;

    public const KEY_CSRF = 'csrf';

    public const KEY_SUCCESS_MESSAGE = 'success_message';

    public const KEY_ERROR_MESSAGE = 'error_message';

    public const KEY_CURRENT_ATTEMPT_ID = 'attempt_id';

    public const KEY_QUESTIONS_ANSWERED = 'questions_answered';

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

    public function setSuccessMessage(string $message): void
    {
        $this->set(self::KEY_SUCCESS_MESSAGE, $message);
    }
    public function setErrorMessage(string $message): void
    {
        $this->set(self::KEY_ERROR_MESSAGE, $message);
    }
    public function hasSuccessMessage(): bool
    {
        return (bool)$this->get(self::KEY_SUCCESS_MESSAGE);
    }
    public function hasErrorMessage(): bool
    {
        return (bool)$this->get(self::KEY_ERROR_MESSAGE);
    }
    /**
     * Returns the success message set in session if any and unsets it automatically (it's a 'Flash message')
     * @return string|null
     */
    public function getSuccessMessage(): ?string
    {
        $message = $this->get(self::KEY_SUCCESS_MESSAGE);
        $this->unset(self::KEY_SUCCESS_MESSAGE);
        return $message;
    }
    /**
     * Returns the error message set in session if any and unsets it automatically (it's a 'Flash message')
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        $message = $this->get(self::KEY_ERROR_MESSAGE);
        $this->unset(self::KEY_ERROR_MESSAGE);
        return $message;
    }
}
<?php

declare(strict_types=1);

namespace Project\Exceptions;

use Exception;

class UserRegistrationValidationException extends Exception
{
    public array $errorMessages = [];
}
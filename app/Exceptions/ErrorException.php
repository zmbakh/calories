<?php

namespace App\Exceptions;

class ErrorException extends \Exception
{
    protected array $errors;

    /**
     * ErrorException constructor.
     * @param  string  $message
     * @param  int  $code
     * @param  array  $errors
     */
    public function __construct(string $message = '', int $code = 500, array $errors = [])
    {
        parent::__construct($message, $code);

        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}

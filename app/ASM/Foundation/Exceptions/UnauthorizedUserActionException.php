<?php namespace ASM\Foundation\Exceptions;

class UnauthorizedUserActionException extends \Exception {
    /**
     * @var mixed
     */
    protected $errors;
    /**
     * @param string $message
     * @param mixed $errors
     */
    function __construct($message, $errors = null)
    {
        $this->errors = $errors;
        parent::__construct($message);
    }
    /**
     * Get form validation errors
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
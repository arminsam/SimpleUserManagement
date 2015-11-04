<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandValidator;

class ResetUserPasswordValidator extends ASMCommandValidator implements CommandBus {

    /**
     * validation rules
     *
     * @var array
     */
    protected $rules = [
        'password'  => 'required|min:5|max:255|confirmed'
    ];

    /**
     * validate command data
     *
     * @param mixed $command
     * @return mixed
     * @throws ValidationFailedException
     */
    public function execute ($command)
    {
        $this->validateCommand($command);
    }
}
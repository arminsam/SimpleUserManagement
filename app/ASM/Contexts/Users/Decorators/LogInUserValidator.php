<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandValidator;

class LogInUserValidator extends ASMCommandValidator implements CommandBus {

    /**
     * validation rules
     *
     * @var array
     */
    protected $rules = [
        'username'  => 'required',
        'password'  => 'required'
    ];

    /**
     * validate command data
     *
     * @param mixed $command
     * @return mixed
     * @throws ValidationFailedException
     */
    public function execute($command)
    {
        $this->validateCommand($command);
    }

}
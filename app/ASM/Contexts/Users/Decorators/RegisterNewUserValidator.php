<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Contexts\Users\Commands\RegisterNewUserCommand;
use ASM\Foundation\ASMCommandValidator;

class RegisterNewUserValidator extends ASMCommandValidator implements CommandBus {

    /**
     * validation rules
     *
     * @var array
     */
    protected $rules = [
        'username'  => 'required|min:5|max:25|unique:users|regex:/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/',
        'email'     => 'required|min:5|max:255|unique:users|email',
        'name'      => 'required|max:255',
        'password'  => 'sometimes|required|min:5|max:255|confirmed'
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
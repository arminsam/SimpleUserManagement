<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandValidator;

class UpdateUserProfileValidator extends ASMCommandValidator implements CommandBus {

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * validate command data
     *
     * @param mixed $command
     * @return mixed
     * @throws ValidationFailedException
     */
    public function execute($command)
    {
        $this->setRules($command);

        $this->validateCommand($command);
    }


    /**
     * @param $command
     */
    protected function setRules($command)
    {
        $this->rules = [
            'username' => 'required|min:5|max:25|unique:users,username,' . $command->userId . ',id',
            'email' => 'required|min:5|max:255|email|unique:users,email,' . $command->userId . ',id',
            'name' => 'required|max:255'
        ];
    }

}
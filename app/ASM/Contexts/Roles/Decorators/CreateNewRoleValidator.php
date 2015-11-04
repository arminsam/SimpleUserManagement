<?php namespace ASM\Contexts\Roles\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandValidator;

class CreateNewRoleValidator extends ASMCommandValidator implements CommandBus {

    /**
     * validation rules
     *
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
            'company' => 'sometimes|required',
            'name'  => 'required|max:255|unique:roles'
        ];
    }

}
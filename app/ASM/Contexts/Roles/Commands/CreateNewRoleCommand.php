<?php namespace ASM\Contexts\Roles\Commands;

class CreateNewRoleCommand {

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $capabilities;

    /**
     * @param $name
     * @param $capabilities
     */
    public function __construct($name, $capabilities)
    {
        $this->name = $name;
        $this->capabilities = $capabilities;
    }

}
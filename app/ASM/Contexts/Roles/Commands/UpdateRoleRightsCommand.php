<?php namespace ASM\Contexts\Roles\Commands;

class UpdateRoleRightsCommand {

    /**
     * @var
     */
    public $roleId;
    /**
     * @var
     */
    public $name;
    /**
     * array of capability IDs
     * @var
     */
    public $capabilities;

    /**
     * @param $roleId
     * @param $name
     * @param $capabilities
     */
    public function __construct ($roleId, $name, $capabilities = null)
    {
        $this->roleId = $roleId;
        $this->name = $name;
        $this->capabilities = $capabilities;
    }

}
<?php namespace ASM\Contexts\Roles\Commands;

class DeleteRoleCommand {

    /**
     * @var
     */
    public $roleId;

    /**
     * @param $roleId
     */
    public function __construct ($roleId)
    {
        $this->roleId = $roleId;
    }

}
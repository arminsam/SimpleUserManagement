<?php namespace ASM\Contexts\Users\Commands;

class UpdateUserRolesCommand {

    /**
     * @var
     */
    public $userId;

    /**
     * @var
     */
    public $roleIds;

    /**
     * @param $userId
     * @param $roleIds
     */
    public function __construct($userId, $roleIds = [])
    {
        $this->userId = $userId;
        $this->roleIds = $roleIds;
    }

}
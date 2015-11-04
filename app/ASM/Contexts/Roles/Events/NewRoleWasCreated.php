<?php namespace ASM\Contexts\Roles\Events;

use ASM\Contexts\Roles\Role;

class NewRoleWasCreated {

    /**
     * @var Role
     */
    public $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

}
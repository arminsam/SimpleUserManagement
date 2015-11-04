<?php namespace ASM\Contexts\Roles\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Roles\Role;

class DeleteRoleCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle ($command)
    {
        $role = Role::deleteRole($command->roleId);

        $this->dispatchEventsFor($role);

        return $role;
    }

}
<?php namespace ASM\Contexts\Roles\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Roles\Role;

class UpdateRoleRightsCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle ($command)
    {
        $role = Role::updateRights($command->roleId, $command->name, $command->capabilities);

        $this->dispatchEventsFor($role);

        return $role;
    }

}
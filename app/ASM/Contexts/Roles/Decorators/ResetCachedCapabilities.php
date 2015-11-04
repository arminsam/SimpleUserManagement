<?php namespace ASM\Contexts\Roles\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Contexts\Roles\Role;

class ResetCachedCapabilities implements CommandBus {

    /**
     * @param $command
     *
     * @return mixed
     */
    public function execute($command)
    {
        if (isset($command->userId))
        {
            \Cache::forget('user_capabilities_'.$command->userId);
        }

        if (isset($command->roleId))
        {
            $role = Role::with('users')->findOrFail($command->roleId);

            foreach ($role->users as $user)
            {
                \Cache::forget('user_capabilities_'.$user->id);
            }
        }

        return true;
    }

}
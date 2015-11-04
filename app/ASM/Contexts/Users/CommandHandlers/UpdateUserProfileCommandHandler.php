<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\Commands\UpdateUserRolesCommand;
use ASM\Contexts\Users\User;

class UpdateUserProfileCommandHandler implements CommandHandler {

    use DispatchableTrait, CommanderTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return User
     */
    public function Handle($command)
    {
        $user = User::updateProfile($command->userId, $command->email, $command->username, $command->name);

        if (!is_null($command->roleIds))
        {
            $this->execute(UpdateUserRolesCommand::class);
        }

        $this->dispatchEventsFor($user);

        return $user;
    }

}
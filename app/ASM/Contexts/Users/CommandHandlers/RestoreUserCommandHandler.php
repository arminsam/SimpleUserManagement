<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\User;

class RestoreUserCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::restoreUser($command->userId);

        $this->dispatchEventsFor($user);

        return $user;
    }

}
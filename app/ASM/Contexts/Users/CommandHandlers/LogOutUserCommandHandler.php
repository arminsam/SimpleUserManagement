<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\User;

class LogOutUserCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return User
     */
    public function Handle($command)
    {
        $user = User::logout();

        $this->dispatchEventsFor($user);

        return $user;
    }

}
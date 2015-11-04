<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\User;

class LogInUserCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return User
     */
    public function Handle($command)
    {
        $user = User::login($command->username, $command->password);

        $this->dispatchEventsFor($user);

        return $user;
    }

}
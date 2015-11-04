<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\User;

class ResetUserPasswordCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return User
     */
    public function Handle($command)
    {
        $user = User::where('email', $command->email)->firstOrFail();

        User::updatePassword($user->id, $command->password);

        User::login($user->username, $command->password);

        $this->dispatchEventsFor($user);

        return $user;
    }

}
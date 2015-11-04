<?php namespace ASM\Contexts\Users\CommandHandlers;

use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\Commands\UpdateUserRolesCommand;
use ASM\Contexts\Users\User;

class RegisterNewUserCommandHandler implements CommandHandler {

    use DispatchableTrait, CommanderTrait;
    
    /**
     * Handle the command
     *
     * @param $command
     * @return User
     */
    public function Handle($command)
    {
        $user = User::register($command->email, $command->name, $command->username, $command->password, $command->anonymousUser);

        \Input::merge(['userId' => $user->id]);

        // assign selected roles to the newly registered user
        $this->execute(UpdateUserRolesCommand::class);

        $this->dispatchEventsFor($user);

        return $user;
    }

}
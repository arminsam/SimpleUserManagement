<?php namespace ASM\Contexts\Users\CommandHandlers;

use Illuminate\Support\Facades\Input;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use ASM\Contexts\Users\Commands\UpdateUserRolesCommand;
use ASM\Contexts\Users\User;

class DeleteUserCommandHandler implements CommandHandler {

    use DispatchableTrait, CommanderTrait;

    /**
     * handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        Input::merge(['roleIds' => []]);
        $this->execute(UpdateUserRolesCommand::class);

        $user = User::deleteUser($command->userId);

        $this->dispatchEventsFor($user);

        return $user;
    }

}
<?php namespace ASM\Contexts\Users\Decorators;

use Illuminate\Support\Facades\Auth;
use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandAuthorizer;

class UpdateUserPasswordAuthorizer extends ASMCommandAuthorizer implements CommandBus {

    /**
     * @param $command
     *
     * @throws \ASM\Foundation\Exceptions\UnauthorizedUserAccessException
     * @return mixed
     */
    public function execute($command)
    {
        $this->setAuthorized($command->userId);

        $this->authorizeCommand($command);
    }

    /**
     * @param $userId
     */
    private function setAuthorized($userId)
    {
        if (Auth::user()->id == $userId)
        {
            $this->authorized = ['update_user_password'];
        }
        else
        {
            $this->authorized = ['update_other_users_password'];
        }
    }

}
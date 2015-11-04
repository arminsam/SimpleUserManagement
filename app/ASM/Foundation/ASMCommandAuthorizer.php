<?php namespace ASM\Foundation;

use Illuminate\Support\Facades\Auth;
use ASM\Contexts\Users\User;
use ASM\Foundation\Exceptions\UnauthorizedUserActionException;

class ASMCommandAuthorizer {

    /**
     * @var array
     */
    protected $authorized = [];

    /**
     * @var array
     */
    protected $unauthorized = [];

    /**
     * @param $command
     *
     * @return bool
     * @throws UnauthorizedUserActionException
     */
    public function authorizeCommand($command)
    {
        $user = Auth::check() ? Auth::user() : User::whereUsername($command->username)->first();
        if (!$user || $user->superadmin) return true;

        $userCapabilities = $user->capabilities()->lists('name');

        if ($this->isUnauthorized($userCapabilities) || !$this->isAuthorized($userCapabilities))
        {
            throw new UnauthorizedUserActionException('You are not authorized to do this action');
        }

        return true;
    }

    /**
     * @param $capabilities
     *
     * @return bool
     */
    private function isUnauthorized ($capabilities)
    {
        return count(array_intersect($this->unauthorized, $capabilities)) > 0;
    }

    /**
     * @param $capabilities
     *
     * @return bool
     */
    private function isAuthorized ($capabilities)
    {
        return empty($this->authorized) || count(array_intersect($this->authorized, $capabilities)) > 0;
    }

}
<?php namespace ASM\Contexts\Users\Events;

use ASM\Contexts\Users\User;

class UserHasLoggedOut {

    /**
     * @var User
     */
    public $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
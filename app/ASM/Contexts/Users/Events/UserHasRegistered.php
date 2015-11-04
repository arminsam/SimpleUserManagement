<?php namespace ASM\Contexts\Users\Events;

use ASM\Contexts\Users\User;

class UserHasRegistered {

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $randomPassword;

    /**
     * @param User $user
     * @param string $randomPassword
     */
    public function __construct(User $user, $randomPassword)
    {
        $this->user = $user;
        $this->randomPassword = $randomPassword;
    }
    
}
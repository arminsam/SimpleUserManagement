<?php namespace ASM\Contexts\Users\Events;

use ASM\Contexts\Users\User;

class AnonymousUserHasRegistered {

    /**
     * @var User
     */
    public $user;

    /**
     * @var Employee
     */
    public $randomPassword;

    /**
     * @param User $user
     * @param $randomPassword
     */
    public function __construct(User $user, $randomPassword)
    {
        $this->user = $user;
        $this->randomPassword = $randomPassword;
    }

}
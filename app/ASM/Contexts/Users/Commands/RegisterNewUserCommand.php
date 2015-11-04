<?php namespace ASM\Contexts\Users\Commands;

class RegisterNewUserCommand {

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $username;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $password_confirmation;

    /**
     * @var
     */
    public $roleIds;

    /**
     * @var
     */
    public $anonymousUser;

    /**
     * @param $name
     * @param $email
     * @param $username
     * @param $password
     * @param $password_confirmation
     * @param $roleIds
     * @param bool $anonymousUser
     */
    public function __construct($name, $email, $username, $password, $password_confirmation, $roleIds = [], $anonymousUser = false)
    {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
        $this->roleIds = $roleIds;
        $this->anonymousUser = $anonymousUser;
    }

}
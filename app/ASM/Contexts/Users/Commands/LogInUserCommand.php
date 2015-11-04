<?php namespace ASM\Contexts\Users\Commands;

class LogInUserCommand {

    /**
     * string username/email
     *
     * @var
     */
    public $username;
    /**
     * string password
     *
     * @var
     */
    public $password;

    /**
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

}
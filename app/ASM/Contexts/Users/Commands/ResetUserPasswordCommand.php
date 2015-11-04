<?php namespace ASM\Contexts\Users\Commands;

class ResetUserPasswordCommand {

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $password_confirmation;

    /**
     * @param $email
     * @param $password
     * @param $password_confirmation
     */
    public function __construct($email, $password, $password_confirmation)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }
}
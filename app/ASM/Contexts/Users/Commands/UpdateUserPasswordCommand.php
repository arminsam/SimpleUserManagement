<?php namespace ASM\Contexts\Users\Commands;

class UpdateUserPasswordCommand {

    /**
     * @var
     */
    public $userId;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $password_confirmation;

    /**
     * @param $userId
     * @param $password
     * @param $password_confirmation
     */
    public function __construct ($userId, $password, $password_confirmation)
    {
        $this->userId = $userId;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

}
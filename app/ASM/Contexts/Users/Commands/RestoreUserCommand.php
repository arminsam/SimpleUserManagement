<?php namespace ASM\Contexts\Users\Commands;

class RestoreUserCommand {

    /**
     * @var
     */
    public $userId;

    /**
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

}
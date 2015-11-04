<?php namespace ASM\Contexts\Users\Commands;

class UpdateUserProfileCommand {

    /**
     * @var
     */
    public $userId;

    /**
     * @var
     */
    public $username;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $roleIds;

    /**
     * @param $userId
     * @param $username
     * @param $email
     * @param $name
     * @param null $roleIds
     */
    public function __construct($userId, $username, $email, $name, $roleIds = null)
    {
        $this->userId = $userId;
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->name = $name;
        $this->roleIds = $roleIds;
    }

}
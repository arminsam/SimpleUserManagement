<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandAuthorizer;

class RegisterNewUserAuthorizer extends ASMCommandAuthorizer implements CommandBus {

    /**
     * authorized capabilities
     *
     * @var array
     */
    protected $authorized = [
        'register_other_users'
    ];

    /**
     * @param $command
     *
     * @throws \ASM\Foundation\Exceptions\UnauthorizedUserAccessException
     * @return mixed
     */
    public function execute($command)
    {
        $this->authorizeCommand($command);
    }

}
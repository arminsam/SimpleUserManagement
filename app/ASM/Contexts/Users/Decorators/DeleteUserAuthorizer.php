<?php namespace ASM\Contexts\Users\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandAuthorizer;

class DeleteUserAuthorizer extends ASMCommandAuthorizer implements CommandBus {

    /**
     * authorized capabilities
     *
     * @var array
     */
    protected $authorized = [
        'delete_user'
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
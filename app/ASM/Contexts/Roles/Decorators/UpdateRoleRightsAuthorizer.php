<?php namespace ASM\Contexts\Roles\Decorators;

use Laracasts\Commander\CommandBus;
use ASM\Foundation\ASMCommandAuthorizer;

class UpdateRoleRightsAuthorizer extends ASMCommandAuthorizer implements CommandBus {

    /**
     * authorized capabilities
     *
     * @var array
     */
    protected $authorized = [
        'update_role'
    ];

    /**
     * @param $command
     *
     * @throws \ASM\Foundation\Exceptions\UnauthorizedUserAccessException
     * @return mixed
     */
    public function execute ($command)
    {
        $this->authorizeCommand($command);
    }

}
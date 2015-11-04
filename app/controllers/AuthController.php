<?php

use ASM\Contexts\Users\Commands\LogInUserCommand;
use ASM\Contexts\Users\Commands\LogOutUserCommand;
use ASM\Contexts\Users\Decorators\LogInUserAuthorizer;
use ASM\Contexts\Users\Decorators\LogInUserValidator;
use ASM\Contexts\Users\Decorators\LogOutUserAuthorizer;
use ASM\Contexts\Users\Repository\UserRepositoryInterface;

class AuthController extends \BaseController {

    /*
     * @var
     */
    protected $repository;

    /**
     * @param UserRepositoryInterface $repository
     *
     * @throws Exception
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show login form.
     *
     * @return Response
     */
	public function indexLogin()
	{
		return View::make('users.login', compact('company'));
	}

    /**
     * Log in the user.
     *
     * @return Response
     */
	public function login()
	{
		$this->execute(LogInUserCommand::class, null, [
			LogInUserAuthorizer::class,
			LogInUserValidator::class
		]);

		return Redirect::intended(route('dashboard.index'));
	}

	/**
	 * Log out the user.
	 *
	 * @return Response
	 */
	public function indexLogout()
	{
		$this->execute(LogOutUserCommand::class, null, [
			LogOutUserAuthorizer::class
		]);

		return Redirect::route('login.index');
	}

}
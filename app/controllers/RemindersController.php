<?php

use ASM\Contexts\Users\Commands\ResetUserPasswordCommand;
use ASM\Contexts\Users\Decorators\ResetUserPasswordValidator;
use ASM\Contexts\Users\Repository\UserRepositoryInterface;

class RemindersController extends \BaseController {

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
     * Display the password reminder view.
     *
     * @return Response
     */
	public function indexForgotPassword()
	{
		return View::make('users.remind');
	}

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
	public function forgotPassword()
	{
		$response = Password::remind(['email' => Input::only('email')], function($message)
		{
            $message->subject('Password Reminder')->from('admin@'.\Config::get('app.domain'), 'Site Admin');;
        });

		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->withErrors(Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->withMessage(Lang::get($response));
		}
	}

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     *
     * @return Response
     */
	public function indexResetPassword($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('users.reset')->with('token', $token);
	}

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
	public function resetPassword()
	{
		$this->execute(ResetUserPasswordCommand::class, null, [
			ResetUserPasswordValidator::class
		]);

		return Redirect::route('dashboard.index')->withMessage('Your password is updated.');
	}

}

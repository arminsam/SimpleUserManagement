<?php

use ASM\Configs\DataTables\UserDataTable;
use ASM\Contexts\Roles\Decorators\ResetCachedCapabilities;
use ASM\Contexts\Roles\Role;
use ASM\Contexts\Users\Commands\DeleteUserCommand;
use ASM\Contexts\Users\Commands\RestoreUserCommand;
use ASM\Contexts\Users\Decorators\DeleteUserAuthorizer;
use ASM\Contexts\Users\Decorators\RegisterNewUserAuthorizer;
use ASM\Contexts\Users\Decorators\RestoreUserAuthorizer;
use ASM\Contexts\Users\Repository\UserRepositoryInterface;
use ASM\Contexts\Users\Commands\RegisterNewUserCommand;
use ASM\Contexts\Users\Commands\UpdateUserPasswordCommand;
use ASM\Contexts\Users\Commands\UpdateUserProfileCommand;
use ASM\Contexts\Users\Decorators\RegisterNewUserValidator;
use ASM\Contexts\Users\Decorators\UpdateUserPasswordAuthorizer;
use ASM\Contexts\Users\Decorators\UpdateUserProfileAuthorizer;
use ASM\Contexts\Users\Decorators\UpdateUserProfileValidator;
use ASM\Contexts\Users\Decorators\UpdateUserPasswordValidator;
use ASM\Foundation\BreadcrumbManager\Breadcrumb;
use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigFactory;
use ASM\Foundation\DataManager\DataTable;

class UserController extends \BaseController {

    /*
     * @var
     */
    protected $repository;

    /*
     * @var
     */
    protected $dataTableConfig;

    /*
     * @var
     */
    protected $breadcrumbConfig;

    /**
     * @param UserRepositoryInterface $repository
     * @param UserDataTable $dataTableConfig
     */
    public function __construct(UserRepositoryInterface $repository, UserDataTable $dataTableConfig)
    {
        $this->repository = $repository;
        $this->dataTableConfig = $dataTableConfig;
        $this->breadcrumbConfig = BreadcrumbConfigFactory::create(Route::currentRouteName(), [
            'user.store',
            'user.update',
            'user.destroy',
            'user.restore',
            'user.update.password',
            'user.destroy.multiple',
        ]);
    }

    /**
     * @return mixed
     */
	public function index()
	{
        $data = $this->repository->listAll();
        $dataTable = new DataTable($this->dataTableConfig, $data);
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, []);

        return View::make('users.index', compact('dataTable', 'breadcrumb'));
	}

    /**
     * @return Response
     */
	public function create()
	{
        $roles = Role::all();
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, []);

        return View::make('users.create', compact('breadcrumb', 'roles'));
	}

    /**
     * @return mixed
     */
    public function store()
    {
        $roleIds = Input::has('roleIds') ? Input::get('roleIds') : [];
        $password = $password_confirmation = str_random(8);
        Input::merge(compact('roleIds', 'password', 'password_confirmation'));

        $this->execute(RegisterNewUserCommand::class, null, [
            RegisterNewUserAuthorizer::class,
            RegisterNewUserValidator::class,
            ResetCachedCapabilities::class
        ]);

        return user_can('list_users')
                ? Redirect::route('user.index', [])->withMessage('A new user is registered.')
                : Redirect::route('dashboard.index', [])->withMessage('A new user is registered.');
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function show($userId)
    {
        $user = $this->repository->showUser($userId);
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        return View::make('users.show', compact('user', 'breadcrumb'));
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function edit($userId)
	{
        $user = $this->repository->showUser($userId);
        $roles = Role::all();
        $user->roles = $user->roles->lists('id');
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'user_id' => $userId
        ]);

        return View::make('users.edit', compact('user', 'roles', 'breadcrumb'));
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function update($userId)
	{
        $roleIds = Input::has('roles') ? Input::get('roles') : (user_can('update_user_roles') ? [] : null);
        Input::merge(compact('userId', 'roleIds'));

        $user = $this->execute(UpdateUserProfileCommand::class, null, [
            UpdateUserProfileAuthorizer::class,
            UpdateUserProfileValidator::class,
            ResetCachedCapabilities::class
        ]);

        return user_can('list_users')
                ? Redirect::route('user.index', [])->withMessage('User details are updated.')
                : Redirect::route('dashboard.index', [])->withMessage('User details are updated.');
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
	public function editPassword($userId)
	{
        $user = $this->repository->showUser($userId);
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'user_id' => $user->id
        ]);

		return View::make('users.edit_password', compact('user', 'breadcrumb'));
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
	public function updatePassword($userId)
	{
		Input::merge(compact('userId'));

		$this->execute(UpdateUserPasswordCommand::class, null, [
			UpdateUserPasswordAuthorizer::class,
			UpdateUserPasswordValidator::class
		]);

        return user_can('list_users')
                ? Redirect::route('user.index', [])->withMessage('User password is updated.')
                : Redirect::route('dashboard.index', [])->withMessage('User password is updated.');
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function destroy($userId)
    {
        Input::merge(compact('userId'));

        $this->execute(DeleteUserCommand::class, null, [
            DeleteUserAuthorizer::class
        ]);

        return user_can('list_users')
                ? Redirect::route('user.index', [])->withMessage('User is deleted.')
                : Redirect::route('dashboard.index', [])->withMessage('User is deleted.');
    }

    /**
     * @return mixed
     */
    public function destroyMultiple()
    {
        $userIds = Input::get('rows');

        if (is_null($userIds))
        {
            return Redirect::back()->withErrors('No row was selected.');
        }

        foreach ($userIds as $userId)
        {
            $user = $this->repository->showUser($userId);

            Input::merge(['userId' => $user->id]);
            $this->execute(DeleteUserCommand::class, [], [
                DeleteUserAuthorizer::class
            ]);
        }

        return Redirect::back()->withMessage('selected users are deleted.');
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function restore($userId)
    {
        Input::merge(compact('userId'));

        $this->execute(RestoreUserCommand::class, null, [
            RestoreUserAuthorizer::class
        ]);

        return user_can('list_users')
                ? Redirect::route('user.index', [])->withMessage('User is restored.')
                : Redirect::route('dashboard.index', [])->withMessage('User is restored.');
    }

}
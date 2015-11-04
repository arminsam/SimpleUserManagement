<?php

use ASM\Configs\DataTables\RoleDataTable;
use ASM\Configs\DataTables\UserDataTable;
use ASM\Contexts\Roles\Decorators\ResetCachedCapabilities;
use ASM\Contexts\Roles\Repository\RoleRepositoryInterface;
use ASM\Contexts\Roles\Commands\CreateNewRoleCommand;
use ASM\Contexts\Roles\Commands\DeleteRoleCommand;
use ASM\Contexts\Roles\Commands\UpdateRoleRightsCommand;
use ASM\Contexts\Roles\Decorators\CreateNewRoleAuthorizer;
use ASM\Contexts\Roles\Decorators\CreateNewRoleValidator;
use ASM\Contexts\Roles\Decorators\DeleteRoleAuthorizer;
use ASM\Contexts\Roles\Decorators\UpdateRoleRightsAuthorizer;
use ASM\Contexts\Roles\Decorators\UpdateRoleRightsValidator;
use ASM\Foundation\BreadcrumbManager\Breadcrumb;
use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigFactory;
use ASM\Foundation\DataManager\DataTable;

class RoleController extends \BaseController {

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
    protected $userDataTableConfig;

    /*
     * @var
     */
    protected $breadcrumbConfig;

    /**
     * @param RoleRepositoryInterface $repository
     * @param RoleDataTable $dataTableConfig
     * @param UserDataTable $userDataTableConfig
     */
    public function __construct(RoleRepositoryInterface $repository, RoleDataTable $dataTableConfig, UserDataTable $userDataTableConfig)
    {
        $this->repository = $repository;
        $this->dataTableConfig = $dataTableConfig;
        $this->userDataTableConfig = $userDataTableConfig;
        $this->breadcrumbConfig = BreadcrumbConfigFactory::create(Route::currentRouteName(), [
            'role.store',
            'role.update',
            'role.destroy',
            'role.destroy.multiple'
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

        return View::make('roles.index', compact('dataTable', 'breadcrumb'));
    }

    /**
     * @param $roleId
     *
     * @return mixed
     */
    public function indexUsers($roleId)
    {
        $role = $this->repository->getRole($roleId);
        $data = $this->repository->listUsers($roleId);
        $dataTable = new DataTable($this->userDataTableConfig, $data);
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'role_id' => $roleId
        ]);

        return View::make('roles.index_users', compact('dataTable', 'breadcrumb', 'role'));
    }

    /**
     * show create new role form.
     *
     * @return Response
     */
	public function create()
	{
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, []);

        return View::make('roles.create', compact('breadcrumb'));
	}

    /**
     * create a new role.
     *
     * @return Response
     */
	public function store()
	{
        $capabilities = Input::has('capabilities') ? Input::get('capabilities') : [];
		Input::merge(compact('capabilities'));

		$this->execute(CreateNewRoleCommand::class, null, [
			CreateNewRoleAuthorizer::class,
			CreateNewRoleValidator::class,
            ResetCachedCapabilities::class
		]);

        return user_can('list_roles')
                ? Redirect::route('role.index', [])->withMessage('A new role is created.')
                : Redirect::route('dashboard.index', [])->withMessage('A new role is created.');
	}

    /**
     * @param $roleId
     *
     * @return mixed
     */
    public function show($roleId)
    {
        $role = $this->repository->showRole($roleId);
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'role_id' => $roleId,
            'role_name' => $role->name
        ]);

        return View::make('roles.show', compact('role', 'breadcrumb'));
    }

	/**
	 * @param $roleId
	 *
	 * @return mixed
	 */
    public function edit($roleId)
	{
        $role = $this->repository->showRole($roleId);
        $role->capabilities = $role->capabilities->lists('id');
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, [
            'role_id' => $roleId
        ]);

        return View::make('roles.edit', compact('role', 'breadcrumb'));
	}

    /**
     * @param $roleId
     *
     * @return mixed
     */
    public function update($roleId)
	{
        $capabilities = Input::has('capabilities') ? Input::get('capabilities') : [];
        Input::merge(compact('roleId', 'capabilities'));

        $this->execute(UpdateRoleRightsCommand::class, null, [
            UpdateRoleRightsAuthorizer::class,
            UpdateRoleRightsValidator::class,
            ResetCachedCapabilities::class
        ]);

        return user_can('list_roles')
                ? Redirect::route('role.index', [])->withMessage('Role is updated.')
                : Redirect::route('dashboard.index', [])->withMessage('Role is updated.');
	}

	/**
	 * @param $roleId
	 *
	 * @return mixed
	 */
    public function destroy($roleId)
	{
		Input::merge(compact('roleId'));

		$this->execute(DeleteRoleCommand::class, null, [
			DeleteRoleAuthorizer::class,
            ResetCachedCapabilities::class
		]);

        return user_can('list_roles')
                ? Redirect::route('role.index', [])->withMessage('Role is deleted.')
                : Redirect::route('dashboard.index', [])->withMessage('Role is deleted.');
	}

    /**
     * @return mixed
     */
    public function destroyMultiple()
    {
        $roleIds = Input::get('rows');

        if (is_null($roleIds))
        {
            return Redirect::back()->withErrors('No row was selected.');
        }

        foreach ($roleIds as $roleId)
        {
            $this->execute(DeleteRoleCommand::class, ['roleId' => $roleId], [
                DeleteRoleAuthorizer::class,
                ResetCachedCapabilities::class
            ]);
        }

        return Redirect::back()->withMessage('selected roles are deleted.');
    }

}
<?php namespace ASM\Contexts\Roles\Repository;

use Illuminate\Http\Request;
use ASM\Contexts\Roles\Role;
use ASM\Contexts\Users\User;
use ASM\Foundation\DataManager\DataTableTrait;
use ASM\Foundation\Repository\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface {

    use DataTableTrait {
        DataTableTrait::__construct as private __dtConstruct;
    }

    protected $model;

    /**
     * @param Request $request
     * @param Role $model
     */
    public function __construct(Request $request, Role $model)
    {
        $this->model = $model;
        $this->__dtConstruct($request);
    }

    /**
     * Return a list of roles based on given criteria
     *
     * @return mixed
     */
    public function listAll()
    {
        $query = $this->model
            ->leftJoin('role_user AS role_user', 'role_user.role_id', '=', 'roles.id')
            ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
            ->with('users')
            ->groupBy('roles.id')
            ->distinct();

        return $this->listData($query);
    }

    /**
     * Return a list of users having the given role
     *
     * @param $roleId
     *
     * @return mixed
     */
    public function listUsers($roleId)
    {
        $this->model = new User;
        $this->tableName = $this->model->getTable();

        $query = $this->model->ofRoles($roleId)
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles AS roles', 'role_user.role_id', '=', 'roles.id')
            ->with('roles')
            ->groupBy('users.id')
            ->distinct();

        return $this->listData($query);
    }

    /**
     * Return a single role model
     *
     * @param $roleId
     *
     * @return mixed
     */
    public function showRole($roleId)
    {
        $query = $this->model->with('users', 'capabilities');

        return $query->findOrFail($roleId);
    }

}
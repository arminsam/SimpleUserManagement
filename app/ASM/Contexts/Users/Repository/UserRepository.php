<?php namespace ASM\Contexts\Users\Repository;

use Illuminate\Http\Request;
use ASM\Contexts\Users\User;
use ASM\Foundation\DataManager\DataTableTrait;
use ASM\Foundation\Repository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    use DataTableTrait {
        DataTableTrait::__construct as private __dtConstruct;
    }

    protected $model;

    /**
     * @param Request $request
     * @param User $model
     */
    public function __construct(Request $request, User $model)
    {
        $this->model = $model;
        $this->__dtConstruct($request);
    }

    /**
     * Return a list of users based on given criteria
     *
     * @return mixed
     */
    public function listAll()
    {
        $query = $this->model->withTrashed()
            ->leftJoin('role_user AS role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles AS roles', 'role_user.role_id', '=', 'roles.id')
            ->with('roles')
            ->groupBy('users.id')
            ->distinct();

        return $this->listData($query);
    }

    /**
     * Return a single user model
     *
     * @param $userId
     *
     * @return mixed
     */
    public function showUser($userId)
    {
        return $this->model->with('roles')->findOrFail($userId);
    }

}
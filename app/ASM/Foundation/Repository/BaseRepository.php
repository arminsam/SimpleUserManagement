<?php namespace ASM\Foundation\Repository;

use ASM\Contexts\Roles\Role;
use ASM\Contexts\Users\User;

class BaseRepository {

    /**
     * Return a single user model based on the given user id
     *
     * @param $userId
     * @param array $with
     * @param bool $withTrashed
     *
     * @return null
     */
    public function getUser($userId, $with = [], $withTrashed = false)
    {
        if (!$userId) return null;
        $query = User::with($with);

        return $withTrashed ? $query->withTrashed()->find($userId) : $query->find($userId);
    }

    /**
     * Return a single role model based on the given role id
     *
     * @param $roleId
     * @param array $with
     *
     * @return null
     */
    public function getRole($roleId, $with = [])
    {
        return Role::with($with)->find($roleId);
    }

}
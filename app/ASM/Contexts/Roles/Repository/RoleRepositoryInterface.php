<?php namespace ASM\Contexts\Roles\Repository;

interface RoleRepositoryInterface {

    /**
     * Return a list of roles based on given criteria
     *
     * @return mixed
     */
    public function listAll();

    /**
     * Return a list of users having the given role
     *
     * @param $roleId
     *
     * @return mixed
     */
    public function listUsers($roleId);

    /**
     * Return a single role model
     *
     * @param $roleId
     *
     * @return mixed
     */
    public function showRole($roleId);

}
<?php namespace ASM\Contexts\Users\Repository;

interface UserRepositoryInterface {

    /**
     * Return a list of users based on given criteria
     *
     * @return mixed
     */
    public function listAll();

    /**
     * Return a single user model
     *
     * @param $userId
     *
     * @return mixed
     */
    public function showUser($userId);

}
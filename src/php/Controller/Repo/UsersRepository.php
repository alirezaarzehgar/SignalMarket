<?php

use phpDocumentor\Reflection\Types\Boolean;

require_once __DIR__ . '/../UsersController.php';


class UsersRepository
{
    public function __construct()
    {
        # TODO()
    }

    # create section
    public function addNewUser(UsersModel $user): bool
    {
        # TODO()

        return true;
    }


    # read section

    public function readAllUsers(): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getUserById($id): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getUserByUsername($username): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getUserByEmail($email): ?mysqli_result
    {
        # TODO()

        return null;
    }


    # update section

    public function updateUser(UsersModel $user, $id): ?bool
    {
        #TODO()

        return null;
    }


    # delete section

    public function deleteUserById($id): ?bool
    {
        # TODO()

        return null;
    }

    public function deleteByUsername($username): ?bool
    {
        #TODO()

        return null;
    }

    public function deleteByEmail($email): ?bool
    {
        #TODO

        return null;
    }
}

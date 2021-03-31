<?php

use phpDocumentor\Reflection\Types\Boolean;

require_once __DIR__ . '/../UsersController.php';


class UsersRepository
{
    public $userc;

    public function __construct()
    {
        $this->userc = new UsersController();
    }

    # create section
    public function addNewUser(UsersModel $user): string|bool
    {
        return $this->userc->create($user);
    }


    # read section

    public function readAllUsers(): ?mysqli_result
    {
        return $this->userc->read();
    }

    public function getUserById($id): ?mysqli_result
    {
        foreach ($this->userc->read() as $value)
            if ($value['id'] == $id)
                return $value;

        return null;
    }

    public function getUserByUsername($username): ?array
    {
        $users = [];

        foreach ($this->userc->read() as $value)
            if ($value['username'] == $username)
                $users[] = $value;

        return $users;
    }

    public function getUserByEmail($email): ?array
    {
        $users = [];

        foreach ($this->userc->read() as $value)
            if ($value['email'] == $email)
                $users[] = $value;

        return $users;
    }

    public function getFirstUser(): ?array
    {
        foreach ($this->userc->read() as $value)
            return $value;

        return null;
    }

    public function getLastUser(): ?array
    {
        $user = null;
        foreach ($this->userc->read() as $value)
            $user = $value;

        return $user;
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

    public function deleteUserByUsername($username): ?bool
    {
        #TODO()

        return null;
    }

    public function deleteUserByEmail($email): ?bool
    {
        #TODO

        return null;
    }
}

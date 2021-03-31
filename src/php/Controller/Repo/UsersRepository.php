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

    public function getUserById(int|string $id): ?array
    {
        foreach ($this->userc->read() as $value)
            if ($value['id'] == $id)
                return $value;

        return null;
    }

    public function getUserByUsername($username): ?array
    {
        foreach ((new UsersController())->read() as $value)
            if ($value['username'] == $username)
                return $value;

        return null;
    }

    public function getUserByEmail($email): ?array
    {
        foreach ((new UsersController())->read() as $value)
            if ($value['email'] == $email)
                return $value;

        return null;
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

    public function updateUser(
        UsersModel $user,
        int|string $id
    ): bool|string {
        return $this->userc->update($user, $id);
    }


    # delete section

    public function deleteUserById(int|string $id): ?bool
    {
        return $this->userc->delete($id);
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

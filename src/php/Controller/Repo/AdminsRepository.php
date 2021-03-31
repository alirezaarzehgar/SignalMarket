<?php

require_once __DIR__ . '/../AdminsController.php';


class AdminsRepository
{
    public function __construct()
    {
        # TODO()
    }

    # create section
    public function addNewAdmin(AdminsModel $admin): bool
    {
        # TODO()

        return true;
    }


    # read section

    public function readAllAdmins(): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getAdminById($id): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getAdminByUsername($username): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getAdminByEmail($email): ?mysqli_result
    {
        # TODO()

        return null;
    }


    # update section

    public function updateAdmin(AdminsModel $admin): ?bool
    {
        #TODO()

        return null;
    }


    # delete section

    public function deleteAdminById($id): ?bool
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

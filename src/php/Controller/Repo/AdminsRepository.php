<?php

require_once __DIR__ . '/../AdminsController.php';


class AdminsRepository
{
    public AdminsController $adminc;

    public function __construct()
    {
        $this->adminc = new AdminsController();
    }

    # create section
    public function addNewAdmin(AdminsModel $admin): bool
    {
        return $this->adminc->create($admin);
    }


    # read section

    public function readAllAdmins(): ?mysqli_result
    {
        return $this->adminc->read();
    }

    private function getUserByCondition(
        string $key,
        string $val
    ): ?array {
        foreach ($this->adminc->read() as $value)
            if ($value[$key] == $val)
                return $value;

        return null;
    }

    public function getAdminById(int|string $id): ?array
    {
        return $this->getUserByCondition("id", $id);
    }

    public function getAdminByUsername(string $username): ?array
    {
        return $this->getUserByCondition("username", $username);
    }

    public function getAdminByPermission(string|int $permission): ?array
    {
        $users = [];

        foreach ($this->adminc->read() as $value)
            if ($value['permission'] == $permission)
                array_push($users, $value);

        return $users;
    }

    public function getFirstAdmin(): ?array
    {
        foreach ($this->adminc->read() as $value)
            return $value;

        return null;
    }

    public function getLastAdmin(): ?array
    {
        $user = null;
        foreach ($this->adminc->read() as $value)
            $user = $value;

        return $user;
    }

    # update section

    public function updateAdmin(
        AdminsModel $admin,
        string|int $id
    ): ?bool {
        return $this->adminc->update($admin, $id);
    }


    # delete section

    public function deleteAdminById(string|int $id): ?bool
    {
        return $this->adminc->delete($id);
    }

    public function deleteAdminByUsername(string $username): ?bool
    {
        $admin = $this->getAdminByUsername($username);

        return $this->adminc->delete($admin['id']);
    }
}

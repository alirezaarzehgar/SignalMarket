<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../src/php/Model/AdminsModel.php';

class AdminsRepoTest extends TestCase
{
    # create section
    public function testAddNewAdmin()
    {
        $repo = new AdminsRepository();

        $admin = new AdminsModel(
            username: "new admin",
            password: "1234",
            permission: "7"
        );

        $excepted = true;
        $result = $repo->addNewAdmin($admin);

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # read section

    public function testReadAllAdmins()
    {
        $repo = new AdminsRepository();

        $excepted = (new AdminsController())->read();
        $result = $repo->readAllAdmins();

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminById()
    {
        $repo = new AdminsRepository();
        $id = 2;

        foreach ((new AdminsController())->read() as $value)
            if ($value['id'] == $id)
                $excepted = $value;

        if (!isset($excepted))
            $excepted = null;

        $result = $repo->getAdminById($id);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminByUsername()
    {
        $repo = new AdminsRepository();
        $username = 2;

        foreach ((new AdminsController())->read() as $value)
            if ($value['username'] == $username)
                $excepted = $value;

        if (!isset($excepted))
            $excepted = null;

        $result = $repo->getAdminByUsername($username);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminByPermission()
    {
        $repo = new AdminsRepository();
        $permission = 755;
        $excepted = [];

        foreach ((new AdminsController())->read() as $value)
            if ($value['permission'] == $permission)
                array_push($excepted, $value);

        $result = $repo->getAdminByPermission($permission);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function getFirstAdmin()
    {
        $repo = new AdminsRepository();

        foreach ((new AdminsController())->read() as $value) {
            $excepted = $value;
            break;
        }

        if (!isset($excepted))
            $excepted = null;

        $result = $repo->getFirstAdmin();

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function getLastAdmin()
    {
        $repo = new AdminsRepository();

        foreach ((new AdminsController())->read() as $value)
            $excepted = $value;

        if (!isset($excepted))
            $excepted = null;

        $result = $repo->getLastAdmin();

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # update section

    public function testUpdateAdmin()
    {
        $repo = new AdminsRepository();

        $admin = new AdminsModel(
            username: "updated admin username",
            permission: "7"
        );

        $excepted = true;
        $result = $repo->updateAdmin($admin, 3);

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # delete section

    public function testDeleteAdminById()
    {
        $repo = new AdminsRepository();
        $id = $repo->getLastAdmin()['id'];

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testDeleteAdminByUsername()
    {
        $repo = new AdminsRepository();

        $excepted = true;
        $result = $repo->deleteAdminByUsername("new admin");

        $this->assertEquals(
            $excepted,
            $result
        );
    }
}

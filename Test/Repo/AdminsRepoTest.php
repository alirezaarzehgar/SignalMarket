<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';

class AdminsRepoTest extends TestCase
{
    # create section
    public function testAddNewAdmin()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # read section

    public function testReadAllAdmins()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminById()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminByUsername()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetAdminByPermission()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    # update section

    public function testUpdateAdmin()
    {
        $repo = new AdminsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # delete section

    public function testDeleteAdminById()
    {
        $repo = new AdminsRepository();

        #TODO

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

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }
}

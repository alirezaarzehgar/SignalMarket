<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/php/Controller/UsersController.php';


class UsersRepositoryTest extends TestCase
{
    # create section
    public function testAddNewUser()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }


    # read section

    public function testReadAllUsers()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    public function testGetUserById()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    public function testGetUserByUsername()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    public function testGetUserByEmail()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    public function testGetFirstUser()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    public function testGetLastUser()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }

    # update section

    public function testUpdateUser()
    {
        $repo = new UsersRepository();

        #TODO()
        $this->assertTrue(true);
    }


    # delete section

    public function testDeleteUserById()
    {
        $repo = new UsersRepository();

        # TODO()
        $this->assertTrue(true);
    }

    public function testDeleteUserByUsername()
    {
        $repo = new UsersRepository();

        #TODO()
        $this->assertTrue(true);
    }

    public function testDeleteUserByEmail()
    {
        $repo = new UsersRepository();

        #TODO
        $this->assertTrue(true);
    }
}

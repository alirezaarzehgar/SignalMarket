<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/php/Controller/Repo/UsersRepository.php';


class UsersRepositoryTest extends TestCase
{
    # create section
    public function testAddNewUser()
    {
        $repo = new UsersRepository();

        $user = new UsersModel(
            username: "new user",
            email: "testAli@gmail",
            password: "1234"
        );

        $expected = true;
        $result = $repo->addNewUser($user);

        $this->assertEquals(
            $expected,
            $result
        );
    }


    # read section

    public function testReadAllUsers()
    {
        $repo = new UsersRepository();

        $expected = (new UsersController())->read();
        $result = $repo->readAllUsers();

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testGetUserById()
    {
        $repo = new UsersRepository();
        $id = 2;

        foreach ((new UsersController())->read() as $value)
            if ($value['id'] == $id) {
                $expected = $value;
                break;
            }

        $result = $repo->getUserById($id);

        $this->assertEquals(
            $expected,
            $result
        );
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

        $user = $repo->getLastUser();

        $expected = true;
        $result = $repo->deleteUserById($user['id']);

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

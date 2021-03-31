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
        $username = 'ali';

        foreach ((new UsersController())->read() as $value)
            if ($value['username'] == $username) {
                $expected = $value;
                break;
            }

        $result = $repo->getUserByUsername($username);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testGetUserByEmail()
    {
        $repo = new UsersRepository();
        $email = 'hamed@gmail.com';

        foreach ((new UsersController())->read() as $value)
            if ($value['email'] == $email) {
                $expected = $value;
                break;
            }

        $result = $repo->getUserByEmail($email);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testGetFirstUser()
    {
        $repo = new UsersRepository();

        foreach ((new UsersController())->read() as $value) {
            $expected = $value;
            break;
        }


        $result = $repo->getFirstUser();

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testGetLastUser()
    {
        $repo = new UsersRepository();

        foreach ((new UsersController())->read() as $value)
            $expected = $value;


        $result = $repo->getLastUser();

        $this->assertEquals(
            $expected,
            $result
        );
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

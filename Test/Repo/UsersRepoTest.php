<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/php/Controller/Repo/UsersRepository.php';


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


        if (!isset($expected))
            $expected = false;

        $result = $repo->getUserById($id);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testGetUserByUsername()
    {
        $repo = new UsersRepository();
        $username = 'mohammad';

        foreach ((new UsersController())->read() as $value)
            if ($value['username'] == $username) {
                $expected = $value;
                break;
            }

        if (!isset($expected))
            $expected = false;

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

        if (!isset($expected))
            $expected = false;

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

        $user = new UsersModel(
            "edited user name",
            "editedemailaddress@gmail.com",
            "412"
        );

        $expected = true;
        $result = $repo->updateUser(
            $user,
            $repo->getFirstUser()['id']
        );

        $this->assertEquals(
            $expected,
            $result
        );
    }


    # delete section

    public function testDeleteUserById()
    {
        $repo = new UsersRepository();

        $expected = true;
        $result = $repo->deleteUserById(
            $repo->getLastUser()['id']
        );

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testDeleteUserByUsername()
    {
        $repo = new UsersRepository();

        $user = new UsersModel(
            username: "useless user",
            email: "userless@gmail.com",
            password: "1234"
        );

        $repo->addNewUser($user);

        $username = $user->username ?: "something";

        $user = $repo->getUserByUsername(
            $username
        );

        $expected = true;
        $result = $repo->deleteUserByUsername($user['username']);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testDeleteUserByEmail()
    {
        $repo = new UsersRepository();

        $user = new UsersModel(
            username: "useless user",
            email: "userless@gmail.com",
            password: "1234"
        );

        $repo->addNewUser($user);

        $username = $user->username ?: "something";

        $user = $repo->getUserByUsername(
            $username
        );

        $expected = true;
        $result = $repo->deleteUserByEmail(
            $user['email']
        );

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

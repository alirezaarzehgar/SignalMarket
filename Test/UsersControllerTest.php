<?php

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\TypeName;

use function PHPSTORM_META\type;

require_once __DIR__ . '/../src/php/Model/UsersModel.php';
require_once __DIR__ . '/../src/php/Controller/UsersController.php';


class UsersControllerTest extends TestCase
{
    private function getLastRow()
    {
        $usrc = new UsersController();
        $rec = $usrc->read();

        $id = null;

        foreach ($rec as $value) {
            $id = $value['id'];
        }

        return $id;
    }

    private function showAll()
    {
        $usrc = new UsersController();

        //  show all database
        foreach ($usrc->read() as $value) {
            # echo $value['id'] . "\t" . $value['username'] . "\t" . $value['password'] . "\t" . $value['email'] . "\n";
        }
    }

    public function testCreate()
    {
        $usrc = new UsersController();

        $user = new UsersModel(
            "hosein" . rand(),
            "ali@mamad" . rand(),
            md5("123")
        );

        $result = $usrc->create($user);
        $expected = true;

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testRead()
    {
        $usrc = new UsersController();

        //  show all database
        foreach ($usrc->read() as $value) {
            $this->assertNotEmpty($value['id']);
            $this->assertNotEmpty($value['username']);
            $this->assertNotEmpty($value['password']);
            $this->assertNotEmpty($value['email']);

            #echo $value['id'] . "\t" . $value['username'] . "\t" . $value['password'] . "\t" . $value['email'] . "\n";
        }
    }

    public function testUpdate()
    {
        $usrc = new UsersController();

        $user = new UsersModel(
            "single"
        );

        $expected = true;
        $result = $usrc->update(
            $user,
            $this->getLastRow()
        );

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testDelete()
    {
        $usrc = new UsersController();

        $expected = true;
        $result = $usrc->delete($this->getLastRow());

        $this->showAll();

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

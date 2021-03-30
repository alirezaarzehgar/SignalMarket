<?php

require_once __DIR__ . '/../src/php/Model/AdminsModel.php';
require_once __DIR__ . '/../src/php/Controller/AdminsController.php';

use PHPUnit\Framework\TestCase;

class AdminsControllerTest extends TestCase
{
    private function getLastId()
    {
        $adminc = new AdminsController();

        foreach ($adminc->read() as $value) {
            $id = $value['id'];
        }

        return $id;
    }

    public function testCreate()
    {
        $admin = new AdminsModel(
            "new admin",
            "mama",
            775
        );

        $adminc = new AdminsController();

        $expected = true;
        $result = $adminc->create($admin);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testRead()
    {
        $adminc = new AdminsController();

        foreach ($adminc->read() as $value) {;
            $this->assertNotEmpty($value['id']);
            $this->assertNotEmpty($value['username']);
            $this->assertNotEmpty($value['password']);
            $this->assertNotEmpty($value['permission']);
        }
    }

    public function testUpdate()
    {
        $adminc = new AdminsController();

        $admin = new AdminsModel(
            "edited admin",
            222
        );

        $expected = true;
        $result = $adminc->update($admin, $this->getLastId());

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testDelete()
    {
        $adminc = new AdminsController();

        $expected = true;
        $result = $adminc->delete($this->getLastId());

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

<?php

require_once __DIR__ . '/../src/php/Model/ProductsModel.php';
require_once __DIR__ . '/../src/php/Controller/ProductsController.php';

use PHPUnit\Framework\TestCase;

class ProductsControllerTest extends TestCase
{
    public function testCreate()
    {
        $proc = new ProductsController();

        $product = new ProductsModel(
            admin_name: "ali",
            subject: "subject",
            photo_dir_path: "/path",
            introduction_to_product: "intro",
            choosen_by_customer: false,
            choosen_by_admin: false,
            success_payment: false
        );

        $expected = true;
        $result = $proc->create($product);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testRead()
    {
        $proc = new ProductsController();

        $expected = "object";
        $result = gettype($proc->read());

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

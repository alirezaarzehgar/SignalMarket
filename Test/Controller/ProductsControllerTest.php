<?php

require_once __DIR__ . '/../../src/php/Model/ProductsModel.php';
require_once __DIR__ . '/../../src/php/Controller/ProductsController.php';

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

    public function testUpdate()
    {
        $proc = new ProductsController();


        // first level update
        $product = new ProductsModel(
            choosen_by_customer: true,
            sent_signal_dir_path: "/path/signal",
            customer_name: "ali",
            expected_date: "2020-8-12",
            sent_date: "2020-10-20"
        );


        $expected = true;
        $result = $proc->update($product, 1);

        $this->assertEquals(
            $expected,
            $result
        );

        //  add next level
        $product = new ProductsModel(
            choosen_by_admin: true,
            price: "10$",
            accepted_date: "2020-10-20"
        );


        $expected = true;
        $result = $proc->update($product, 1);

        $this->assertEquals(
            $expected,
            $result
        );


        // add next level
        $product = new ProductsModel(
            success_payment: true
        );


        $expected = true;
        $result = $proc->update($product, 1);

        $this->assertEquals(
            $expected,
            $result
        );

        // add next level

        $product = new ProductsModel(
            final_product_path: "/path/fnal-product"
        );


        $expected = true;
        $result = $proc->update($product, 1);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function testDelete()
    {
        $proc = new ProductsController();

        foreach ($proc->read() as $value)
            $index = $value['id'];

        $expected = true;
        $result = $proc->delete($index);

        $this->assertEquals(
            $expected,
            $result
        );
    }
}

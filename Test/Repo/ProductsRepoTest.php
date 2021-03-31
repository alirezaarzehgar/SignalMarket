<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/php/Controller/Repo/ProductsRepository.php';
require_once __DIR__ . '/../../src/php/Model/ProductsModel.php';


class ProductsRepoTest extends TestCase
{
    # create section
    public function testAddNewProduct()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # read section

    public function testGetAllProducts()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductById()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsByAdminName()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsByCustomerName()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsWithChoosenByCustomer()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsWithChoosenByAdmin()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsBySuccessPayment()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetFinishedProducts()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    # update section

    public function testUpdateProduct()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductCreateNewProductByAdmin()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductChooseCustomerByUser()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductChooseAdminByAdmin()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateSuccessPaymentByUser()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    # delete section

    public function testDeleteProductById()
    {
        $repo = new ProductsRepository();

        #TODO

        $excepted = true;
        $result = true;

        $this->assertEquals(
            $excepted,
            $result
        );
    }
}

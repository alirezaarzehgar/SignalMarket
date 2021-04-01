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

        $excepted = true;
        $result = $repo->addNewProduct(
            admin_name: "ali",
            subject: "new product",
            photo_dir_path: "/path",
            introduction_to_product: "new product registred from test app"
        );

        $this->assertEquals(
            $excepted,
            $result
        );
    }


    # read section

    public function testGetAllProducts()
    {
        $repo = new ProductsRepository();

        $excepted = (new ProductsController())->read();
        $result = $repo->getAllProducts();

        while ($valE = $excepted->fetch_assoc() and $valR = $result->fetch_assoc())
            $this->assertEquals(
                $valE,
                $valR
            );
    }

    public function testGetProductById()
    {
        $repo = new ProductsRepository();
        $excepted = null;
        $id = 1;

        $prod = (new ProductsController())->read();

        while ($value = $prod->fetch_assoc())
            if ($value['id'] == $id)
                $excepted = $value;

        $result = $repo->getProductById($id);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsByAdminName()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $admin_name = 'ali';

        $prod = (new ProductsController())->read();

        while ($value = $prod->fetch_assoc())
            if ($value['admin_name'] == $admin_name)
                array_push($excepted, $value);

        $result = $repo->getProductsByAdminName($admin_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsByCustomerName()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $customer_name = "";

        $prod = (new ProductsController())->read();

        while ($value = $prod->fetch_assoc())
            if ($value['customer_name'] == $customer_name)
                array_push($excepted, $value);

        $result = $repo->getProductsByCustomerName($customer_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsWithChoosenByCustomer()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $customer_name = "";

        $prodE = (new ProductsController())->read();

        while ($value = $prodE->fetch_assoc())
            if (
                $value['choosen_by_customer'] == true and
                $value['customer_name'] == $customer_name
            )
                array_push($excepted, $value);

        $result = $repo->getProductsWithChoosenByCustomer($customer_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsWithChoosenByAdmin()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $customer_name = "";

        $prodE = (new ProductsController())->read();

        while ($value = $prodE->fetch_assoc())
            if (
                $value['choosen_by_admin'] == true and
                $value['customer_name'] == $customer_name
            )
                array_push($excepted, $value);

        $result = $repo->getProductsWithChoosenByAdmin($customer_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetProductsBySuccessPayment()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $customer_name = "";

        $prodE = (new ProductsController())->read();

        while ($value = $prodE->fetch_assoc())
            if (
                $value['success_payment'] == true and
                $value['customer_name'] == $customer_name
            )
                array_push($excepted, $value);

        $result = $repo->getProductsBySuccessPayment($customer_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testGetFinishedProducts()
    {
        $repo = new ProductsRepository();
        $excepted = [];
        $customer_name = "";

        $prodE = (new ProductsController())->read();


        while ($value = $prodE->fetch_assoc())
            if (
                !empty($value['final_product_path']) and
                $value['customer_name'] == $customer_name
            )
                array_push($excepted, $value);

        $result = $repo->getFinishedProducts($customer_name);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function getLastProduct()
    {
        $repo = new ProductsRepository();
        $excepted = null;
        $prodE = (new ProductsController())->read();

        while ($value = $prodE->fetch_assoc())
            $excepted = $value;

        $result = $repo->getLastProduct();

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    # update section

    public function testUpdateProduct()
    {
        $repo = new ProductsRepository();

        $product = new ProductsModel(
            success_payment: false
        );

        $excepted = true;
        $result = $repo->updateProduct($product, 1);

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductCreateNewProductByAdmin()
    {
        $repo = new ProductsRepository();

        $excepted = true;
        $result = $repo->updateProductCreateNewProductByAdmin(
            admin_name: "mohammad",
            subject: "selected from test",
            photo_dir_path: "/edited/path",
            introduction_to_product: "intro",
            id: 1
        );

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductChooseCustomerByUser()
    {
        $repo = new ProductsRepository();

        $excepted = true;
        $result = $repo->updateProductChooseCustomerByUser(
            sent_signal_dir_path: "/new/path",
            customer_name: "mohammad",
            expected_date: "2020-5-12",
            sent_date: "2020-6-12",
            id: 1
        );

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateProductChooseAdminByAdmin()
    {
        $repo = new ProductsRepository();

        $excepted = true;
        $result = $repo->updateProductChooseAdminByAdmin(
            price: "15$",
            accepted_date: "2020-9-12",
            id: 1
        );

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    public function testUpdateSuccessPaymentByUser()
    {
        $repo = new ProductsRepository();

        $excepted = true;
        $result = $repo->updateSuccessPaymentByUser(
            success_payment: false,
            id: 1
        );

        $this->assertEquals(
            $excepted,
            $result
        );
    }

    # delete section

    public function testDeleteProductById()
    {
        $repo = new ProductsRepository();

        $product = $repo->getLastProduct();

        $excepted = true;
        $result = $repo->deleteProductById($product['id']);

        $this->assertEquals(
            $excepted,
            $result
        );
    }
}

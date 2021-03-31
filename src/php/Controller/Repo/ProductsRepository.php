<?php

require_once __DIR__ . '/../ProductsController.php';

class ProductsRepository
{
    public function __construct()
    {
        # TODO()
    }

    # create section
    public function addNewProduct(
        ProductsModel $product = null,
        $admin_name = null,
        $subject = null,
        $photo_dir_path = null,
        $introduction_to_product = null
    ): bool {
        # TODO()

        return true;
    }


    # read section

    public function getAllProducts(): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getProductById($id): ?mysqli_result
    {
        # TODO()

        return null;
    }

    public function getProductsByAdminName($admin_name): ?mysqli_result
    {
        #TODO()

        return null;
    }

    public function getProductsByCustomerName($customer_name): ?mysqli_result
    {
        #TODO()

        return null;
    }

    public function getProductsWithChoosenByCustomer(
        $customer_name,
        $isChoosen = true
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    public function getProductsWithChoosenByAdmin(
        $customer_name,
        $isChoosen = true
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    public function getProductsBySuccessPayment(
        $customer_name,
        $isSuccess = true
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    public function getFinishedProducts(
        $customer_name,
        $isFinished
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    # update section

    public function updateProduct(ProductsModel $product): ?bool
    {
        #TODO()

        return null;
    }

    public function updateProductCreateNewProductByAdmin(
        ProductsModel $product = null,
        $admin_name = null,
        $subject = null,
        $photo_dir_path = null,
        $introduction_to_product = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateProductChooseCustomerByUser(
        ProductsModel $product = null,
        $sent_signal_dir_path = null,
        $customer_name = null,
        $expected_date = null,
        $sent_date = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateProductChooseAdminByAdmin(
        ProductsModel $product = null,
        $choosen_by_admin = null,
        $price = null,
        $accepted_date = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateSuccessPaymentByUser($success_payment, $id): ?bool
    {
        #TODO()

        return null;
    }

    # delete section

    public function deleteProductById($id): ?bool
    {
        # TODO()

        return null;
    }
}

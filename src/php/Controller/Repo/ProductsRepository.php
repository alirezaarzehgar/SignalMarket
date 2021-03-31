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
        string $admin_name = null,
        string $subject = null,
        string $photo_dir_path = null,
        string $introduction_to_product = null
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

    public function getProductById(string|int $id): ?array
    {
        # TODO()

        return null;
    }

    public function getProductsByAdminName(string $admin_name): ?array
    {
        #TODO()

        return null;
    }

    public function getProductsByCustomerName(string $customer_name): ?array
    {
        #TODO()

        return null;
    }

    public function getProductsWithChoosenByCustomer(
        string $customer_name,
        bool $isChoosen = true
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    public function getProductsWithChoosenByAdmin(
        string $customer_name,
        bool $isChoosen = true
    ): ?mysqli_result {
        #TODO()

        return null;
    }

    public function getProductsBySuccessPayment(
        string $customer_name,
        bool $isSuccess = true
    ): ?array {
        #TODO()

        return null;
    }

    public function getFinishedProducts(
        string $customer_name,
        bool $isFinished
    ): ?array {
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
        string $admin_name = null,
        string $subject = null,
        string $photo_dir_path = null,
        string $introduction_to_product = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateProductChooseCustomerByUser(
        ProductsModel $product = null,
        string $sent_signal_dir_path = null,
        string $customer_name = null,
        string $expected_date = null,
        string $sent_date = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateProductChooseAdminByAdmin(
        ProductsModel $product = null,
        bool $choosen_by_admin = null,
        string $price = null,
        string $accepted_date = null
    ): ?bool {
        #TODO()

        return null;
    }

    public function updateSuccessPaymentByUser(
        bool $success_payment,
        string|int $id
    ): ?bool {
        #TODO()

        return null;
    }

    # delete section

    public function deleteProductById(string|int $id): ?bool
    {
        # TODO()

        return null;
    }
}

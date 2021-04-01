<?php

require_once __DIR__ . '/../ProductsController.php';

class ProductsRepository
{
    public ProductsController $proc;

    public function __construct()
    {
        $this->proc = new ProductsController();
    }

    # create section
    public function addNewProduct(
        ProductsModel $product = null,
        string $admin_name = null,
        string $subject = null,
        string $photo_dir_path = null,
        string $introduction_to_product = null
    ): bool {
        if (is_null($product)) {
            $product = new ProductsModel(
                admin_name: $admin_name,
                subject: $subject,
                photo_dir_path: $photo_dir_path,
                introduction_to_product: $introduction_to_product
            );
        }

        return $this->proc->create($product);
    }


    # read section

    public function getAllProducts(): ?mysqli_result
    {
        return $this->proc->read();
    }

    private function getProductWithCondition(
        string|int $key,
        string $val
    ): ?array {
        $prod = $this->proc->read();
        while ($value = $prod->fetch_assoc())
            if ($value[$key] == $val)
                return $value;

        return null;
    }

    private function getProductsWithCondition(
        string|int $key,
        string $val
    ): array {
        $products = [];

        $prod = $this->proc->read();
        while ($value = $prod->fetch_assoc())
            if ($value[$key] == $val)
                array_push($products, $value);

        return $products;
    }

    public function getProductById(string|int $id): ?array
    {
        return $this->getProductWithCondition('id', $id);
    }

    public function getProductsByAdminName(string $admin_name): ?array
    {
        return $this->getProductsWithCondition("admin_name", $admin_name);
    }

    public function getProductsByCustomerName(string $customer_name): ?array
    {
        return $this->getProductsWithCondition("customer_name", $customer_name);
    }

    private function getProductsWithConditionAndCustomer(
        string $key,
        string|int $val,
        string $customer_name
    ): ?array {
        $products = [];

        $prod = $this->proc->read();

        while ($value = $prod->fetch_assoc())
            if (
                $value[$key] == $val and
                $value['customer_name'] == $customer_name
            )
                array_push($products, $value);

        return $products;
    }

    public function getProductsWithChoosenByCustomer(
        string $customer_name,
        bool $isChoosen = true
    ): ?array {
        return $this->getProductsWithConditionAndCustomer(
            key: 'choosen_by_customer',
            val: $isChoosen,
            customer_name: $customer_name
        );
    }

    public function getProductsWithChoosenByAdmin(
        string $customer_name,
        bool $isChoosen = true
    ): ?array {
        return $this->getProductsWithConditionAndCustomer(
            key: 'choosen_by_admin',
            val: $isChoosen,
            customer_name: $customer_name
        );
    }

    public function getProductsBySuccessPayment(
        string $customer_name,
        bool $isSuccess = true
    ): ?array {
        return $this->getProductsWithConditionAndCustomer(
            key: 'success_payment',
            val: $isSuccess,
            customer_name: $customer_name
        );
    }

    public function getFinishedProducts(
        string $customer_name,
        bool $isFinished = true
    ): ?array {
        $products = [];

        $prod = $this->proc->read();

        while ($value = $prod->fetch_assoc())
            if (
                !empty($value['final_product_path']) and
                $value['customer_name'] == $customer_name
            )
                array_push($products, $value);

        return $products;
    }

    public function getLastProduct(): ?array
    {
        $product = null;
        $prod = $this->proc->read();

        while ($value = $prod->fetch_assoc())
            $product = $value;

        return $product;
    }

    # update section

    public function updateProduct(
        ProductsModel $product,
        string|int $id
    ): ?bool {
        return $this->proc->update($product, $id);
    }

    public function updateProductCreateNewProductByAdmin(
        ProductsModel $product = null,
        string $admin_name = null,
        string $subject = null,
        string $photo_dir_path = null,
        string $introduction_to_product = null,
        string|int $id
    ): ?bool {
        if (is_null($product)) {
            $product = new ProductsModel(
                admin_name: $admin_name,
                subject: $subject,
                photo_dir_path: $photo_dir_path,
                introduction_to_product: $introduction_to_product
            );
        }

        return $this->proc->update($product, $id);
    }

    public function updateProductChooseCustomerByUser(
        ProductsModel $product = null,
        string $sent_signal_dir_path = null,
        string $customer_name = null,
        string $expected_date = null,
        string $sent_date = null,
        string|int $id
    ): ?bool {
        if (is_null($product)) {
            $product = new ProductsModel(
                choosen_by_customer: true,
                sent_signal_dir_path: $sent_signal_dir_path,
                customer_name: $customer_name,
                expected_date: $expected_date,
                sent_date: $sent_date
            );
        }

        return $this->proc->update($product, $id);
    }

    public function updateProductChooseAdminByAdmin(
        ProductsModel $product = null,
        string $price = null,
        string $accepted_date = null,
        string|int $id
    ): ?bool {
        if (is_null($product)) {
            $product = new ProductsModel(
                choosen_by_admin: true,
                price: $price,
                accepted_date: $accepted_date
            );
        }

        return $this->proc->update($product, $id);
    }

    public function updateSuccessPaymentByUser(
        bool $success_payment,
        string|int $id
    ): ?bool {
        $product = new ProductsModel(
            success_payment: $success_payment
        );

        return $this->proc->update($product, $id);
    }

    # delete section

    public function deleteProductById(string|int $id): ?bool
    {
        return $this->proc->delete($id);
    }
}

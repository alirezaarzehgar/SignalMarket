<?php

use ProductsModel;

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../Model/ProductsModel.php';

class ProductsController
{
    public $table = "products";

    protected $id = "id";
    protected $admin_name = "admin_name";
    protected $subject = "subject";
    protected $photo_dir_path = "photo_dir_path";
    protected $introduction_to_product = "introduction_to_product";

    protected $choosen_by_customer = "choosen_by_customer";
    protected $sent_signal_dir_path = "sent_signal_dir_path";
    protected $customer_name = "customer_name";
    protected $expected_date = "expected_date";
    protected $sent_date = "sent_date";

    protected $choosen_by_admin = "choosen_by_admin";
    protected $price = "price";
    protected $accepted_date = "accepted_date";

    protected $success_payment = "success_payment";

    protected $final_product_path = "final_product_path";

    protected $conn;

    public function __construct()
    {
        $db = new Database();

        try {
            $this->conn = new mysqli(
                $db->hostname,
                $db->username,
                $db->password,
                $db->dbname
            );

            $this->error = true;
        } catch (Exception $e) {

            $this->error = $e;
        }
    }

    public function create(ProductsModel $product)
    {
        $sql = "INSERT INTO {$this->table} ("
            . "{$this->admin_name},"
            . "{$this->subject},"
            . "{$this->photo_dir_path},"
            . "{$this->introduction_to_product},"

            . "{$this->choosen_by_customer},"

            . "{$this->choosen_by_admin},"

            . "{$this->success_payment}"
            . ") VALUES ("
            . "'{$product->admin_name}',"
            . "'{$product->subject}',"
            . "'{$product->photo_dir_path}',"
            . "'{$product->introduction_to_product}',"

            . "0,"
            . "0,"
            . "0"
            . ")";

        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }

    public function read()
    {
        $sql = "SELECT * FROM {$this->table}";

        $result = $this->conn->query($sql);

        return !$result ? $this->conn->error : $result;
    }

    public function update(ProductsModel $product, $id)
    {
        $admin_name = is_null($product->admin_name) ? $this->admin_name : "'{$product->admin_name}'";
        $subject = is_null($product->subject) ? $this->subject : "'{$product->subject}'";
        $photo_dir_path = is_null($product->photo_dir_path) ? $this->photo_dir_path : "'{$product->photo_dir_path}'";
        $introduction_to_product = is_null($product->photo_dir_path) ? $this->photo_dir_path : "'{$product->photo_dir_path}'";

        $choosen_by_customer = is_null($product->choosen_by_customer) ? $this->choosen_by_customer : "'{$product->choosen_by_customer}'";
        $sent_signal_dir_path = is_null($product->sent_signal_dir_path) ? $this->sent_signal_dir_path : "'{$product->sent_signal_dir_path}'";
        $expected_date = is_null($product->expected_date) ? $this->expected_date : "'{$product->expected_date}'";
        $sent_date = is_null($product->sent_date) ? $this->sent_date : "'{$product->sent_date}'";

        $choosen_by_admin = is_null($product->choosen_by_admin) ? $this->choosen_by_admin : "'{$product->choosen_by_admin}'";
        $price = is_null($product->price) ? $this->price : "'{$product->price}'";
        $accepted_date = is_null($product->accepted_date) ? $this->accepted_date : "'{$product->accepted_date}'";

        $success_payment = is_null($product->success_payment) ? $this->success_payment : "'{$product->success_payment}'";

        $final_product_path = is_null($product->final_product_path) ? $this->final_product_path : "'{$product->final_product_path}'";


        $sql = "UPDATE {$this->table}"
            . " SET {$this->admin_name} = $admin_name,"
            . " {$this->subject} = $subject,"
            . " {$this->photo_dir_path} = $photo_dir_path,"
            . " {$this->introduction_to_product} = $introduction_to_product,"

            . " {$this->choosen_by_customer} = $choosen_by_customer,"
            . " {$this->sent_signal_dir_path} = $sent_signal_dir_path,"
            . " {$this->expected_date} = $expected_date,"
            . " {$this->sent_date} = $sent_date,"

            . " {$this->choosen_by_admin} = $choosen_by_admin,"
            . " {$this->price} = $price,"
            . " {$this->accepted_date} = $accepted_date,"

            . " {$this->success_payment} = $success_payment,"

            . " {$this->final_product_path} = $final_product_path"
            . " WHERE {$this->id} = {$id}";


        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table}"
            . " WHERE {$this->id} = {$id}";

        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }
}

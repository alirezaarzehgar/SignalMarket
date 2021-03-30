<?php

use function PHPUnit\Framework\isEmpty;

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../Model/ProductsModel.php';

class ProductsController
{
    public $table = "products";

    public $admin_name = "admin_name";
    public $subject = "subject";
    public $photo_dir_path = "photo_dir_path";
    public $introduction_to_product = "introduction_to_product";

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
}

<?php

class ProductsModel
{
    /**
     * For Admin
     * 
     * for creating the basic and fundamental product model 
     * we neet to this four column.
     * 
     * this column will filled in level one.
     * 
     * in this section Admin just create a product.
     */
    public $admin_name;                 // NOT NULL
    public $subject;                    // NOT NULL
    public $photo_dir_path;             // NOT NULL
    public $introduction_to_product;    // NOT NULL

    /**
     * For User
     * 
     * when user open index.php he see registerd products that contain above columns.
     * on second section user can choose a product and send your signal file.
     * he also send expected data.
     * also website sent current time to database.
     */
    public $choosen_by_customer;        // NOT NULL
    public $sent_signal_dir_path;
    public $customer_name;
    public $expected_date;
    public $sent_date;


    /**
     * For Admin
     * 
     * when user choose a product, admin can see a new request for his product.
     * 
     * he can accept this request and send your own product price and choosen date.
     */
    public $choosen_by_admin;           // NOT NULL
    public $price;
    public $accepted_date;


    /**
     * For User
     * 
     * user can bay accepted product.
     */
    public $success_payment;            // NOT NULL


    /**
     * For Admin
     * 
     * when user see index, he see various display method of products.
     * 
     * 1 - simple products that admins sent to customers.
     * 2 - products that he sent signal file.
     * 3 - products that admin accept his request.
     * 4 - is own products.
     * 
     * he can use your own product.
     */
    public $final_product_path;


    public function __construct(
        $admin_name = null,
        $subject = null,
        $photo_dir_path = null,
        $introduction_to_product = null,

        $choosen_by_customer = null,
        $sent_signal_dir_path = null,
        $customer_name = null,
        $expected_date = null,
        $sent_date = null,

        $choosen_by_admin = null,
        $price = null,
        $accepted_date = null,

        $success_payment = null,

        $final_product_path = null
    ) {
        $this->admin_name = $admin_name;
        $this->subject = $subject;
        $this->photo_dir_path = $photo_dir_path;
        $this->introduction_to_product = $introduction_to_product;

        $this->choosen_by_customer = $choosen_by_customer;
        $this->sent_signal_dir_path = $sent_signal_dir_path;
        $this->customer_name = $customer_name;
        $this->expected_date = $expected_date;
        $this->sent_date = $sent_date;

        $this->choosen_by_admin = $choosen_by_admin;
        $this->price = $price;
        $this->accepted_date = $accepted_date;

        $this->success_payment = $success_payment;

        $this->final_product_path = $final_product_path;
    }
}

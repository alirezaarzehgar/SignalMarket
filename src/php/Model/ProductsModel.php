<?php

class ProductsModel
{
    public function __construct(
        public $admin_name = null,
        public $subject = null,
        public $photo_dir_path = null,
        public $introduction_to_product = null,

        public $choosen_by_customer = null,
        public $sent_signal_dir_path = null,
        public $customer_name = null,
        public $expected_date = null,
        public $sent_date = null,

        public $choosen_by_admin = null,
        public $price = null,
        public $accepted_date = null,

        public $success_payment = null,

        public $final_product_path = null
    ) {
    }
}

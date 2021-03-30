<?php

class UsersModel
{
    public function __construct(
        public $username = null,
        public $email = null,
        public $password = null
    ) {
    }
}

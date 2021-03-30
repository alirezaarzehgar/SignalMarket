<?php

class UsersModel
{
    public function __construct(
        public $username = null,
        public $email = null,
        public $password = null
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}

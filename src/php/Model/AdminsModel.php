<?php

class AdminsModel
{
    public function __construct(
        public $username = null,
        public $password = null,
        public $permission = null
    ) {
    }
}

class Permission
{
    public static $read = 2;
    public static $write = 6;
}

<?php

require_once __DIR__ . '/PermissionModel.php';

class AdminsModel
{
    public function __construct(
        public $username = null,
        public $password = null,
        public $permission = null
    ) {
    }
}

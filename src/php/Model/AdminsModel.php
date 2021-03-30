<?php

class AdminsModel
{
    public $username;
    public $password;
    public $permission;

    public function __construct(
        $username = null,
        $password = null,
        $permission = null
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->permission = $permission;
    }
}

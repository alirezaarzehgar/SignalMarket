<?php

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../Model/AdminsModel.php';
require_once __DIR__ . '/../Common/Hashing.php';


class AdminsController
{
    protected $table = "admins";

    protected $id = "id";
    protected $username = "username";
    protected $password = "password";
    protected $permission = "permission";

    protected $conn;
    public $error;

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

            $this->error = "success";
        } catch (Exception $e) {

            $this->error = $e;
        }
    }

    public function closeConnection()
    {
        return $this->conn->close();
    }

    public function create(AdminsModel $admin)
    {
        $securePassword = Hashing::encrypt($admin->password ?: "");

        $sql = "INSERT INTO {$this->table} ("
            . "{$this->username},"
            . "{$this->password},"
            . "{$this->permission}"
            . ") VALUES ("
            . "'{$admin->username}',"
            . "'{$securePassword}',"
            . "'{$admin->permission}'"
            . ")";

        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }

    public function read()
    {
        $sql = "SELECT * FROM {$this->table}";

        $result = $this->conn->query($sql);

        if (!$result)
            return $this->conn->error;
        else return $result;
    }

    public function update(
        AdminsModel $admin,
        int|string $id
    ) {
        $securePassword = Hashing::encrypt($admin->password ?: "");

        $username = is_null($admin->username) ? $this->username : "'{$admin->username}'";
        $password = is_null($admin->password) ? $this->password : "'{$securePassword}'";
        $permission = is_null($admin->permission) ? $this->permission : "'{$admin->permission}'";

        $sql = "UPDATE {$this->table}"
            . " SET {$this->username} = {$username},"
            . " {$this->permission} = {$permission},"
            . " {$this->password} = {$password}"
            . " WHERE {$this->id} = {$id}";

        $result = $this->conn->query($sql);

        if ($result)
            return true;
        else return $this->conn->error;
    }

    public function delete(int|string $id)
    {
        $sql = "DELETE FROM {$this->table}"
            . " WHERE {$this->id} = '{$id}'";

        return $this->conn->query($sql);
    }
}

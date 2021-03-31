<?php

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../Model/UsersModel.php';


class UsersController
{
    protected $table = "users";

    protected $id = "id";
    protected $username = "username";
    protected $email = "email";
    protected $password = "password";

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

    public function create(UsersModel $user): string|bool
    {
        $sql = "INSERT INTO {$this->table} ("
            . "{$this->username},"
            . "{$this->email},"
            . "{$this->password}"
            . ") VALUES ("
            . "'{$user->username}',"
            . "'{$user->email}',"
            . "'{$user->password}'"
            . ")";

        if ($this->conn->query($sql))
            return true;
        else return $this->conn->error;
    }

    public function read()
    {
        $sql = "SELECT * FROM {$this->table}";

        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }

    public function update(UsersModel $user, $id)
    {
        $username = is_null($user->username) ? $this->username : "'{$user->username}'";
        $email = is_null($user->email) ? $this->email : "'{$user->email}'";
        $password = is_null($user->password) ? $this->password : "'{$user->password}'";

        $sql = "UPDATE {$this->table}"
            . " SET {$this->username} = {$username},"
            . " {$this->email} = {$email},"
            . " {$this->password} = {$password}"
            . " WHERE {$this->id} = {$id}";

        $result = $this->conn->query($sql);
        return $result ? $result : $this->conn->error;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table}"
            . " WHERE {$this->id} = '{$id}'";

        return $this->conn->query($sql);
    }
}

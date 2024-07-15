<?php
class User
{
    private $conn;
    private $table_name = "user";

    public $id;
    public $name;
    public $email;
    public $address;
    public $password;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (name, email, address, password, status) VALUES (:name, :email, :address, :password, :status)";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read()
    {

        $query = "SELECT id, name, email,status, address FROM " . $this->table_name;
        //$query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function edit()
    {
        $query = "SELECT id, name, email, address,status FROM " . $this->table_name . " WHERE id=" . $this->id . " LIMIT 1";
        $stmt = $this->conn->prepare($query);
        //var_dump($stmt->debugDumpParams());
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, email=:email, address=:address, status=:status WHERE id =" . $this->id;
        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->address = htmlspecialchars(strip_tags($this->address));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":status", $this->status);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id =" . $this->id; 
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()){
            return true;
        }
        return false;
    }
}

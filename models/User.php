<?php
class User
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function createUser($name, $email, $password)
    {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        mysqli_query($this->conn, $query);
    }

    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->conn, $query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}

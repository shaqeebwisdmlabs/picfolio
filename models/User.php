<?php
class User
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function create($name, $email, $password)
    {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        mysqli_query($this->conn, $query);
    }

    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }

        return false;
    }
}

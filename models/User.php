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
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function uploadImage($user_id, $filename, $title)
    {
        $query = "INSERT INTO images (user_id, filename, image_title) VALUES ('$user_id','$filename','$title')";
        return mysqli_query($this->conn, $query);
    }

    public function fetchImage($user_id)
    {
        $query = "SELECT * FROM images WHERE user_id='$user_id'";
        return mysqli_query($this->conn, $query);
    }

    public function updateImageTitle($image_id, $image_title)
    {
        $query = "UPDATE images SET image_title = '$image_title' WHERE id = $image_id";
        return mysqli_query($this->conn, $query);
    }
}

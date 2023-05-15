<?php
class Image
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
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

    public function fetchImageById($image_id)
    {
        $sql = "SELECT * FROM images WHERE id='$image_id'";
        return mysqli_query($this->conn, $sql);
    }
}

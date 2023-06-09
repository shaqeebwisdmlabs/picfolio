<?php

class ImageController
{
    private $userModel;
    private $imageModel;

    public function __construct($userModel, $imageModel)
    {
        $this->userModel = $userModel;
        $this->imageModel = $imageModel;
    }

    public function index()
    {
        if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        return $this->imageModel->fetchImage($user_id);
    }

    public function upload($user_id)
    {
        $errors = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $image_title = $_POST["image-title"];

            if (empty($image_title)) {
                $errors["image_title"] = "Title is required";
            }

            $image = $_FILES["image"];
            $image_name =  pathinfo($image["name"], PATHINFO_FILENAME);
            $image_size = $image["size"];
            $image_ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
            $image_tmp_loc = $image["tmp_name"];

            $max_image_size = 5 * 1024 * 1024; // 5MB
            if ($image_size > $max_image_size) {
                $errors["limit_exceed"] = "Image size must be less than 5MB";
            }

            $unique_name = uniqid() . "-" . $image_name . "." . $image_ext;
            $upload_dir = 'uploads/';
            $upload_path = $upload_dir .  $unique_name;

            if (empty($errors)) {
                if (!move_uploaded_file($image_tmp_loc, $upload_path)) {
                    $errors["upload"] = "Something went wrong while uploading!";
                }
            }

            if (empty($errors)) {
                $upload = $this->imageModel->uploadImage($user_id, $unique_name, $image_title);
                if (!$upload) {
                    $errors["upload"] = "Something went wrong while uploading into database!";
                }
            }

            if (empty($errors)) {
                header("Location: home.php");
                exit();
            }
        }

        return $errors;
    }

    public function update($image_id)
    {
        $errors = array();

        if (isset($_POST['update']) && isset($_POST['image-title'])) {
            $new_title = $_POST['image-title'];

            if (empty($new_title)) {
                $errors["image_title"] = "Title is required";
            }

            if (empty($errors)) {
                $update = $this->imageModel->updateImageTitle($image_id, $new_title);
                if (!$update) {
                    $errors["upload"] = "Something went wrong while updating";
                }
            }

            if (empty($errors)) {
                header("Location: home.php");
                exit();
            }
        }

        return $errors;
    }

    public function delete($conn, $image_id)
    {
        $errors = array();

        if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
            $query = "SELECT * FROM images WHERE id = '$image_id'";
            $result = mysqli_query($conn, $query);
            $image = mysqli_fetch_assoc($result);
            $filename = $image['filename'];

            $upload_dir = 'uploads/';
            unlink($upload_dir . $filename);

            $query = "DELETE FROM images WHERE id = '$image_id'";
            $result = mysqli_query($conn, $query);

            header("Location: home.php");
            exit();
        }

        return $errors;
    }
}

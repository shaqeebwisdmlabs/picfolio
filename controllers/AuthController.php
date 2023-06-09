<?php
class AuthController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function signup($name, $email, $password)
    {
        $errors = array();
        // Validate name
        if (empty($name)) {
            $errors["name"] = "Name is required";
        } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors["name"] = "Only letters and white space allowed";
        }

        // Validate email
        if (empty($email)) {
            $errors["email"] = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format";
        }

        // Validate password
        if (empty($password)) {
            $errors["password"] = "Password is required";
        } else if (strlen($password) < 8) {
            $errors["password"] = "Password must be at least 8 characters long";
        }

        $user = $this->model->findUserByEmail($email);

        if ($user) {
            $errors["email"] = "Email is already registered";
        }

        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->model->createUser($name, $email, $hashedPassword);

            $user = $this->model->findUserByEmail($email);
            session_start();
            $_SESSION["user_id"] = $user["user_id"];

            header("Location: /home.php");
            exit();
        }

        return $errors;
    }

    public function login($email, $password)
    {
        $errors = array();
        // Validate email
        if (empty($email)) {
            $errors["email"] = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format";
        }

        // Validate password
        if (empty($password)) {
            $errors["password"] = "Password is required";
        }

        $user = $this->model->findUserByEmail($email);

        if ($user && password_verify($password, $user["password"]) && empty($errors)) {
            session_start();
            $_SESSION["user_id"] = $user["user_id"];
            header("Location: /home.php");
            exit();
        } else {
            $errors["login"] = "Invalid email or password";
        }

        return $errors;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        session_destroy();

        header("Location: login.php");
        exit();
    }
}

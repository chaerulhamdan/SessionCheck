<?php

    require_once('./connection.php');
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //Handle Get Request
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users(username, password) VALUES ('$username', '$hash');";
            $connection->query
            ($query);
            header('Location: ../login.php');
        }
    }

<?php
    session_start();

    require_once('./connection.php');
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //Handle Get Request
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE
            username = '$username';";
            $result = $connection->query($query);

            // $query = "INSERT INTO users(username, password) VALUES ('$username', '$hash');";
            // $connection->query
            // ($query);

            if($result->num_rows > 0){
                // data valid
                $row = $result->fetch_assoc();
                if(password_verify($password , $row['password'])) {
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $time = time();

                    $user_ip = getenv('REMOTE_ADDR');
                    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                    $city = $geo["geoplugin_city"];

                    $_SESSION['is_login'] = true;
                    $_SESSION['ip_address'] = $ip_address;
                    $_SESSION['username'] = $useragent;
                    $_SESSION['lastLogin'] = $time;
                    $_SESSION['city'] = $city;
                    

                    //print_r($row);

                    header('Location: ../check.php');
                } else {
                    var_dump("password salah.");
                    die;
                }
                
            } else {
                // Data tidak ada
                var_dump("Username atau password salah.");
                die;
            }
        }
    }
?>
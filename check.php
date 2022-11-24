<?php
session_start();
function checkSessionValidity(){
        print_r($_SESSION);
        if ($_SESSION['is_login'] !== true) {
            var_dump("is_login not true");
            session_destroy();
            die;
            header('Location: ./login.php');  
        }
        if (!isset($_SESSION['is_login'])) {
            var_dump("is_login not set");
            die;
            header('Location: ./login.php');
        }
        if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
            var_dump("ip address not valid");
            session_destroy();
            die;
            header('Location: ./login.php');  
        }
        if (!isset($_SESSION['ip_address'])) {
            var_dump("ip not set");
            die;
            header('Location: ./login.php');
        }
        if ($_SESSION['username'] !== $_SERVER['HTTP_USER_AGENT']) {
            var_dump("username not valid");
            session_destroy();
            die;
            header('Location: ./login.php');  
        }
        if (!isset($_SESSION['username'])) {
            var_dump("username not set");
            die;
            header('Location: ./login.php');
        }
        if (time() - $_SESSION['lastLogin'] > 43200) {
            var_dump("lifetime not valid");
            session_destroy();
            die;
            header('Location: ./login.php');  
        }
        if (!isset($_SESSION['lastLogin'])) {
            var_dump("time not set");
            die;
            header('Location: ./login.php');
        }
        $user_ip = getenv('REMOTE_ADDR');
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $city = $geo["geoplugin_city"];
        if ($_SESSION['city'] !== $city) {
            var_dump("city not valid");
            session_destroy();
            die;
            header('Location: ./login.php');  
        }
        if (!isset($_SESSION['city'])) {
            var_dump("city not set");
            die;
            header('Location: ./login.php');
        }
    }

    checkSessionValidity();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tranqsite</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/hack.css">
    <link rel="stylesheet" href="assets/dark.css">
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>
    <h1>You Are Login</h1>
</body>

</html>
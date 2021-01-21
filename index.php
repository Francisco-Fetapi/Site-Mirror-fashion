<?php

    if(isset($_COOKIE['id_user'])){
        session_start();
        $_SESSION['id_usuario'] = $_COOKIE['id_user'];
        header('location: home-page.php');
    }else{
        session_start();
        $_SESSION['id_usuario'] = '';
        header('location: login.php');
    }

?>
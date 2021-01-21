<?php
    session_start();
    $_SESSION['id_usuario'] = '';
    setcookie('id_user'); //apagar a info do usuario localmente
?>
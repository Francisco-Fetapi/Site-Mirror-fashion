<?php

require_once "funcoes.php";

    $num_tel = $_GET['tel'];
    $senha = $_GET['senha'];    
    if(user_existe($num_tel,$senha)){
        session_start();
        $_SESSION['id_usuario'] = $num_tel; 
        //guarda os dados de sessao na maquina do usuario
        $tempo = time() + 60*60*24*120; //vai durar 120 dias
        setcookie('id_user',$num_tel,$tempo);
    }else{
        echo "erro";
    }

?>
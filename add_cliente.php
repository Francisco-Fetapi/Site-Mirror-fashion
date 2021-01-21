<?php

    require_once "conexao.php";
    require_once "funcoes.php";

        $bd->select_db('mirror-fashion');

        $nome = $_GET['nome'];
        $data_nasc = $_GET['data_nasc'];
        $genero = $_GET['genero'];
        $num_tel = $_GET['num_tel'];
        $password = $_GET['passe'];
        $email = $_GET['email'];

        $res = $bd->query('SELECT * FROM clientes');
        if(!existe_no_banco($num_tel,$res)){
            $sql = "INSERT INTO clientes(nome, data_de_nascimento,email,genero,palavra_passe,num_tel,foto) VALUES(
                '$nome',
                '$data_nasc',
                '$email',
                '$genero',
                '$password',
                '$num_tel',
                'user.jpg'
            )";
    
        $bd->query($sql);
        session_start();
        $_SESSION['id_usuario'] = $num_tel;
        //guarda os dados de sessao na maquina do usuario
        $tempo = time() + 60*60*24*120; //vai durar 120 dias
        setcookie('id_user',$num_tel,$tempo);    
    }else{
        echo "erro";
    }
?>
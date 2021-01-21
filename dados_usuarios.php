<?php
    session_start();

    if($_SESSION['id_usuario'] == ''){
        header('location: login.php');
    }else{
        require "conexao.php";
        $bd->select_db('mirror-fashion');
        $numTel = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM clientes WHERE num_tel = '$numTel'";
        $dados = $bd->query($sql);
        $usuario = array();
        while($r = $dados->fetch_object()){
            $usuario['id'] = $r->id;
            $usuario['nome'] = $r->nome;
            $usuario['data_nascimento'] = $r->data_de_nascimento;
            $usuario['email'] = $r->email;
            $usuario['genero'] = $r->genero;
            $usuario['passe'] = $r->palavra_passe;
            $usuario['num_tel'] = $r->num_tel;
            $usuario['foto'] = $r->foto;
        }        
    }
    
?>
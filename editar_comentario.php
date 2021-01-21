<?php

    require 'conexao.php';
    $bd->select_db('mirror-fashion');

    $id_comentario = $_POST['id_comentario'];
    $op = $_POST['op'];
    $texto = $_POST['texto'];

    if($op == 'atualizar'){
        $sql = "UPDATE comentarios SET conteudo = '$texto' WHERE id = '$id_comentario'";
        $bd->query($sql);
    }else{
        $sql = "DELETE FROM comentarios WHERE id = '$id_comentario'";
        $bd->query($sql);
    }

?>
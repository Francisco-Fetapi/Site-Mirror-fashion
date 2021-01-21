<?php 

    require 'conexao.php';
    $bd->select_db('mirror-fashion');

    $id_cliente = $_POST['id_cliente'];
    $id_comentario = $_POST['id_comentario'];
    $ato = $_POST['ato'];

    if($ato == "dislikar"){
        $sql = "DELETE FROM comentarios_reacoes WHERE id_cliente = '$id_cliente' AND id_comentario = '$id_comentario'";
        $bd->query($sql);
        echo "Gosto Retirado";
    }else{
        $sql = "INSERT INTO comentarios_reacoes(id_comentario,id_cliente) VALUES('$id_comentario','$id_cliente')";
        $bd->query($sql);
        echo "Gosto dado";
    }    
?>
<?php
    require 'conexao.php';
    $bd->select_db('mirror-fashion');

    $id_comentario = $_POST['id_comentario'];
    
    $sql = "SELECT id_cliente FROM comentarios_reacoes WHERE id_comentario = '$id_comentario'";
    $id_clientes = $bd->query($sql);

    while($cliente = $id_clientes->fetch_object()){
        $sql = "SELECT nome FROM clientes WHERE id = '$cliente->id_cliente'";
        $nome_cliente = (($bd->query($sql))->fetch_object())->nome;

        echo $nome_cliente." <br> ";
    }

?>
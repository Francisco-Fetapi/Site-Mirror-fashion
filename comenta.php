<?php
    require_once 'dados_usuarios.php';

    $conteudo = $_POST['conteudo'];
    $id_prod = $_POST['id_prod'];
    $id_usuario = $usuario['id'];
    $data = date('Y/m/d');
    $hora = date('H:i');

    $sql = "INSERT INTO comentarios (id_prod,id_cliente,conteudo,data_hora) VALUES(
        '$id_prod',
        '$id_usuario',
        '$conteudo',
        NOW()
    )";

    if($bd->query($sql)){
        echo "Comentario guardado \n";
    }
    echo "$conteudo foi comentado no produto com id = $id_prod";
?>
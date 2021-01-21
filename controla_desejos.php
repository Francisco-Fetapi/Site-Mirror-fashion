<?php
    include 'dados_usuarios.php';

    $id_prod = $_POST['id_prod'];
    $deseja = $_POST['desejar'];
    $id_user = $usuario['id'];
    $data = date('Y/m/d');

    if($deseja == 'sim'){
        $sql = "INSERT INTO desejos(id_prod,id_cliente,data) VALUES('$id_prod','$id_user','$data')";
        $bd->query($sql);
    }else{
        $sql = "DELETE FROM desejos WHERE id_prod = '$id_prod'";
        $bd->query($sql);
    }

?>
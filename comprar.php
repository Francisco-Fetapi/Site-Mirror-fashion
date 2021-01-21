<?php

require_once "dados_usuarios.php";

$nome = $_POST['nome'];//v
$cor = $_POST['cor'];
$tamanho = $_POST['tamanho'];
$preco = $_POST['preco']; //v
$qtd = $_POST['qt'];
$total = $_POST['tot'];
$id_user = $usuario['id'];

$id_prod = $bd->query("SELECT id FROM produtos WHERE nome='$nome' ");
$id_prod = $id_prod->fetch_object();

$data = date('Y-m-d');

$sql = "INSERT INTO vendas (id_prod,id_cliente,data,cor,tamanho,quantidade,total) VALUES(
    '$id_prod->id',
    '$id_user',
    '$data',
    '$cor',
    '$tamanho',
    '$qtd',
    '$total'
)";
if($bd->query($sql)){
    // echo "A compra foi efetuada com sucesso <br/>";
    $prod = $bd->query("SELECT vendas FROM produtos WHERE id ='$id_prod->id' ");
    $prod = $prod->fetch_object();

    $num_vendas = $qtd + $prod->vendas;
    $bd->query("UPDATE produtos SET vendas='$num_vendas' WHERE id ='$id_prod->id' ");
 
    $sql = "SELECT * FROM desejos WHERE id_prod='$id_prod->id' AND id_cliente = '$id_user'";
    if(($bd->query($sql))->num_rows > 0 ){
        $sql = "DELETE FROM desejos WHERE id_prod = '$id_prod->id'";
        $bd->query($sql);
    }

    header("location: todos_produtos.php#rd");
}
?>
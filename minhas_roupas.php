<?php

    if(!isset($_COOKIE['id_user'])){
        header('location: index.php');
    }
    //preparando todos os produtos
    require_once 'dados_usuarios.php';
    $id_us = $usuario['id'];
    $sql = "SELECT * FROM vendas WHERE id_cliente = '$id_us' ORDER BY id DESC";
    $res = $bd->query($sql);

    if($res->num_rows > 0){
        while($v = $res->fetch_object()){
            $id_produto = $v->id_prod;
            $sql = "SELECT * FROM produtos WHERE id = '$id_produto'";
            $results = $bd->query($sql);
            $produto = $results->fetch_object();
?>
        <div class="media" data-id="<?php echo $produto->id ?>">
            <div class="media-left">
                <figure>
                    <img src="img/produtos/<?php echo $produto->foto?>-<?php echo $v->cor ?>.png" alt="">
                    <figcaption>
                        <span class="qtd" data-total="<?php echo $v->total ?>"><?php echo $v->quantidade ?></span>
                        <h3 class="i" style="opacity:1;"><?php echo $produto->preco?></h3>
                    </figcaption>
                </figure>
            </div>
            <div class="media-body">
                <div class="desc1">
                    <h3><?php echo $produto->nome?></h3>
                    <p class="info">
                        Data da compra: <span class="data"><?php echo $v->data ?></span><br>
                        Comprado por: <span><?php echo $produto->vendas - 1 ?> outra(s) pessoa(s)</span>
                    </p>
                </div>
                <div class="desc2">
                    <p><?php echo $produto->descricao ?></p>
                </div>
            </div>
        </div>
<?php
    }
}else{
    echo "<h1 class='aviso1'>Nenhuma compra efetuada até agora!</h1>";
}
?>
<script src="script.js"></script>
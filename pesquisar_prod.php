<?php
    include 'dados_usuarios.php';
    include 'funcoes.php';

    $tabela = $_POST['tabela'];
    $termo = $_POST['termo'];
    $id_us = $usuario['id'];

    echo "<h2 class='k'>Resultados para '$termo'</h2>";
    if($tabela == 'produtos'){
        $sql0 = "SELECT * FROM produtos WHERE nome LIKE '%$termo%'";
        $resu = $bd->query($sql0);
        while($p = $resu->fetch_object()){
            $id_prod = $p->id;
            $sql = "SELECT * FROM comentarios WHERE id_prod = '$id_prod' ";
            $r = $bd->query($sql);
            $num_comentarios = $r->num_rows;            
            ?>    
            <div class="media">
        <div class="media-left">
            <figure>
                <img src="img/produtos/<?php echo $p->foto?>-azul.png" alt="">
                <figcaption>
                    <?php if(!foi_comprado($usuario['id'],$id_prod)){
                            if(existe_desejo($usuario['id'],$id_prod)){
                        ?>
                            <span class="fa fa-heart i ic desejado" data-id="<?php echo $id_prod ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$id_prod)?>"></span>
                        <?php 
                        }else{ 
                            ?>
                            <span class="fa fa-heart i ic" data-id="<?php echo $id_prod ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$id_prod)?>"></span>
                        <?php } 
                        }?>
                    <a href="produto.php?<?php echo "id_prod=$id_prod"?>"><span class="glyphicon glyphicon-shopping-cart i icc"></span></a>
                    <h3 class="i"><?php echo $p->preco?></h3>
                </figcaption>
                <?php 
                    if(foi_comprado($usuario['id'],$id_prod)){
                        echo "<span class='iii'>Comprado</span>";
                    }
                ?>
            </figure>
        </div>
        <div class="media-body">
            <div class="desc1">
                <h3><?php echo destaca_parte($termo,"<span class='foco'>$termo</span>",$p->nome)?></h3>
                <p class="info">
                    Data: <span class="data"><?php echo $p->data ?></span><br>
                    Comentarios: <span><?php echo $num_comentarios ?></span>
                </p>
            </div>
            <div class="desc2">
                <p><?php echo $p->descricao ?></p>
            </div>
        </div>
    </div>
            <?php
    }
}
?>

<?php
    if($tabela == 'vendas'){
        $sql = "SELECT * FROM vendas WHERE id_cliente = '$id_us' ORDER BY id DESC";
        $res = $bd->query($sql);

        if($res->num_rows > 0){
                $contador = 0;
                while($v = $res->fetch_object()){
                    $id_produto = $v->id_prod;
                    $sql = "SELECT * FROM produtos WHERE id = '$id_produto' AND nome LIKE '%$termo%'";
                    $results = $bd->query($sql);
                    if($results->num_rows > 0){
                        $contador++;
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
                    <h3><?php echo destaca_parte($termo,"<span class='foco'>$termo</span>",$produto->nome)?></h3>
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
    }
}else{
    echo "<h1 class='aviso1'>Nenhuma compra efetuada até agora! <br> Compre roupas aqui para puderes visualizar</h1>";
}
}
?>

<?php
    if($tabela == 'desejos'){
        $sql = "SELECT * FROM desejos WHERE id_cliente = '$id_us'";
        $res = $bd->query($sql);

        if($res->num_rows > 0){

        while($d = $res->fetch_object()){
            $id_prod_des = $d->id_prod; //o id do prod desejado
            $data_desejo = $d->data;

            //todas as info desse prod
            $sql0 = "SELECT * FROM produtos WHERE id = '$id_prod_des' AND nome LIKE '%$termo%'";
            $j = $bd->query($sql0);
            if($j->num_rows > 0){

            $p = $j->fetch_object();
            $id_prod = $p->id;

            //os comentarios desse prod
            $sql = "SELECT * FROM comentarios WHERE id_prod = '$id_prod' ";
            $r = $bd->query($sql);
            $num_comentarios = $r->num_rows;
    ?>
    <div class="media">
        <div class="media-left">
            <figure>
                <img src="img/produtos/<?php echo $p->foto?>-azul.png" alt="">
                <figcaption>
                    <?php 
                            if(existe_desejo($usuario['id'],$id_prod)){
                        ?>
                            <span class="fa fa-heart i ic desejado" data-id="<?php echo $id_prod ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$id_prod)?>"></span>
                        <?php 
                        }else{ 
                            ?>
                            <span class="fa fa-heart i ic" data-id="<?php echo $id_prod ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$id_prod)?>"></span>
                        <?php } ?>
                    <a href="produto.php?<?php echo "id_prod=$id_prod"?>"><span class="glyphicon glyphicon-shopping-cart i icc"></span></a>
                    <h3 class="i"><?php echo $p->preco?></h3>
                </figcaption>
            </figure>
        </div>
        <div class="media-body">
            <div class="desc1">
                <h3><?php echo destaca_parte($termo,"<span class='foco'>$termo</span>",$p->nome) ?></h3>
                <p class="info">
                    Data: <span class="data"><?php echo $p->data ?></span><br>
                    Desejaste em: <span class="data"><?php echo $data_desejo ?></span><br>
                    Comentarios: <span><?php echo $num_comentarios ?></span>
                </p>
            </div>
            <div class="desc2">
                <p><?php echo $p->descricao ?></p>
            </div>
        </div>
    </div>
<?php
    }
    }
}else{
    echo "<h1 class='aviso1'>Você ainda não tem desejos! </h1>";
}
}
?>

<script src="script.js"></script>
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip({ 
                placement: 'right',
                delay:{hide:800},
                html:true 
            }); 
    })
</script>
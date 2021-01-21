<?php
    //preparando todos os dados necessarios
    require 'dados_usuarios.php';
    require 'funcoes.php';

    $id_us = $usuario['id'];

    $sql = "SELECT * FROM desejos WHERE id_cliente = '$id_us'";
    $res = $bd->query($sql);

    if($res->num_rows > 0){

    while($d = $res->fetch_object()){
        $id_prod_des = $d->id_prod; //o id do prod desejado
        $data_desejo = $d->data;

        //todas as info desse prod
        $sql0 = "SELECT * FROM produtos WHERE id = '$id_prod_des'";
        $p = ($bd->query($sql0))->fetch_object();
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
                <h3><?php echo $p->nome ?></h3>
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
}else{
    echo "<h1 class='aviso1'>Você ainda não tem desejos! </h1>";
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
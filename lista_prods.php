<?php
    //preparando todos os dados necessarios
    require 'dados_usuarios.php';
    require 'funcoes.php';


    $sql = "SELECT * FROM produtos";
    $res = $bd->query($sql);

    while($p = $res->fetch_object()){
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
                <h3><?php echo $p->nome?></h3>
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
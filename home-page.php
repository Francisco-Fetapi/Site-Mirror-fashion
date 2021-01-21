<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos2.css">
    <link rel="stylesheet" href="css/home-page.css">
</head>
<body class="bg-dark text-white">
<?php
    require_once 'dados_usuarios.php';
    require_once 'dados_produtos.php';
    require_once 'views/cabecalho.php';
    require 'funcoes.php';
?>  
        <br/>
        <div class="container">
                <main>
                <?php
                    for($c=1;$c<=6;$c++){
                    // configuando os comentarios
                    $id_prod = $produto[$c]['id'];

                    $sql = "SELECT * FROM comentarios WHERE id_prod = '$id_prod' ";
                    $res = $bd->query($sql);
                    $num_comentarios = $res->num_rows;
                    $msg_comentarios = "";
                        if($num_comentarios==0){
                            $msg_comentarios = "nenhum comentário";
                        }else{
                            if($num_comentarios==1){
                                $msg_comentarios = "&nbsp;$num_comentarios comentário";
                            }else{
                                $msg_comentarios = "&nbsp;$num_comentarios comentários";
                            }
                        }
                ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="produto.php?id_prod=<?php echo $produto[$c]['id'] ?>">
                                <figure>
                                    <img src="img/produtos/<?php echo $produto[$c]['foto'] ?>-verde.png" alt="">
                                    <figcaption>
                                        <?php echo $produto[$c]['preco'] ?>
                                    </figcaption>
                                    <?php 
                                        if(foi_comprado($usuario['id'],$produto[$c]['id'])){
                                            echo "<span class='iii'>Comprado</span>";
                                        }
                                    ?>
                                </figure>
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="produto.php?id_prod=<?php echo $produto[$c]['id'] ?>"><h4><?php echo $produto[$c]['nome'] ?></h4></a>
                            <p class="info text-center">
                                Data:<span class="data"><?php echo $produto[$c]['data'] ?></span> <span class="glyphicon glyphicon-time"></span> 
                                <br/> <?php echo $msg_comentarios ?> <span class="fa fa-comments"></span>
                            </p>
                            <p>
                                <?php echo $produto[$c]['desc'] ?>
                            </p>
                            <?php
                            if(!foi_comprado($usuario['id'],$produto[$c]['id'])){ 
                                if(existe_desejo($usuario['id'],$produto[$c]['id'])){
                            ?>
                                <span class="fa fa-heart ic desejado" data-id="<?php echo $produto[$c]['id'] ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$produto[$c]['id'])?>"></span>
                            <?php 
                            }else{ 
                                ?>
                                <span class="fa fa-heart ic" data-id="<?php echo $produto[$c]['id'] ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$produto[$c]['id'])?>"></span>
                            <?php } 
                            }?>
                        </div>
                    </div>
                    <?php } ?>
                    <button class="btn btn-block btn-outline-dark" onclick="window.location.href = 'todos_produtos.php'">Ver todos os produtos da loja <span class="fa fa-shopping-cart"></span></button>
                </main>

                <aside class="row">
                    
                    <section id="vendidos">
                        <h3>Mais vendidos</h3>
                        <figure>
                            <?php 
                                for($c=1;$c<=4;$c++){
                            ?>
                                <a href="produto.php?id_prod=<?php echo $mais_vendidos[$c]['id']?>"><img src="img/produtos/<?php echo $mais_vendidos[$c]['foto']?>-rosa.png" alt=""></a>
                            <?php } ?>
                        </figure>
                    </section>

                    <section id="novidades">
                        <h3 class="text-center">Novidades</h3>
                        <?php for($c=1;$c<=4;$c++){ 
                            // configuando os comentarios
                            $id_prod = $novidades[$c]['id'];

                            $sql = "SELECT * FROM comentarios WHERE id_prod = '$id_prod' ";
                            $res = $bd->query($sql);
                            $num_comentarios = $res->num_rows;
                            $msg_comentarios = "";
                            if($num_comentarios==0){
                                $msg_comentarios = "nenhum comentário";
                            }else{
                                if($num_comentarios==1){
                                    $msg_comentarios = "&nbsp;<b>$num_comentarios</b> comentário";
                                }else{
                                    $msg_comentarios = "&nbsp;<b>$num_comentarios</b> comentários";
                                }
                            }
                            ?>
                        <div class="thumbnail bg-dark">
                        <a href="produto.php?id_prod=<?php echo $novidades[$c]['id'] ?>"><img src="img/produtos/<?php echo $novidades[$c]['foto'] ?>-verde.png" alt=""></a>
                            <div class="caption">
                                <p class="info">
                                Data:<span class="data"><?php echo $novidades[$c]['data'] ?></span> <span class="glyphicon glyphicon-time"></span> <?php echo $msg_comentarios ?> <span class="fa fa-comments"></span>
                                </p>
                                <a href="produto.php?id_prod=<?php echo $novidades[$c]['id'] ?>"><h4><?php echo $novidades[$c]['nome'] ?></h4></a>
                                <p class="text-white">
                                    <?php echo $novidades[$c]['desc'] ?>
                                </p>
                                <?php 
                                if(existe_desejo($usuario['id'],$novidades[$c]['id'])){
                            ?>
                                <span class="fa fa-heart ic desejado" data-id="<?php echo $produto[$c]['id'] ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$produto[$c]['id'])?>"></span>
                            <?php 
                            }else{ 
                                ?>
                                <span class="fa fa-heart ic" data-id="<?php echo $produto[$c]['id'] ?>" data-toggle="tooltip" title="<?php echo contaDesejos($usuario['id'],$produto[$c]['id'])?>"></span>
                            <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </section>
                </aside>
        </div>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="script.js"></script>
    <script>
        $(function(){
            $('.media').click(function(){
                if(!$(this).children('.ic').hasClass('desejado')){
                    
                }else{
                    var end = $(this).children('.media-left').children('a').attr('href');
                    window.location.href = end;
                }
            })
            $('[data-toggle="tooltip"]').tooltip({ 
                placement: 'top',
                delay:{hide:800},
                html:true
            }); 
        })
    </script>

</body>
</html>
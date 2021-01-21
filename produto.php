<?php


    // preparar todos os dados do prduto escolhido
    $id_prod = $_GET['id_prod'];
    require "conexao.php";
    $bd->select_db('mirror-fashion');

    $sql = "SELECT * FROM produtos WHERE id = '$id_prod'";
    $res = $bd->query($sql);
    $produto = $res->fetch_object();

    require 'dados_usuarios.php';
    $bd->select_db('mirror-fashion');
    $qtd_prods = ($bd->query('SELECT * FROM produtos'))->num_rows;
    $id_u = $usuario['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produto->nome ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/produto.css">
</head>
<body>
    
   <?php include_once("views/cabecalho2.php") ?>
    <br><br><br><br><br>
    <main>
        <div class="col-xs-12">
            <div class="thumbnail">
                <img src="img/produtos/<?php echo $produto->foto ?>-rosa.png" alt="" id="foto">
            </div>
        </div>
        <div class="info col-xs-12">
            <div class="i">
                <h1><?php echo $produto->nome ?></h1>
                <p>por apenas <?php echo $produto->preco ?></p>
            </div>
            <div class="row">
                <form class="col-xs-12">
                    <div id="cor" class="col-xs-12 col-md-6">
                        <legend>Escolha a cor:</legend>
                        <input type="radio" name="cor" id="red" class="rosa" checked>
                        <label for="red" class="c"></label>

                        <input type="radio" name="cor" id="blue" class="azul">
                        <label for="blue" class="c"></label>

                        <input type="radio" name="cor" id="green" class="verde">
                        <label for="green" class="c"></label>
                    </div>
                    <div id="tamanho" class="col-xs-12 col-md-6">
                        <legend>Escolha seu tamanho</legend>
                        <input type="range" name="tam" id="tm" min="32" step="2" max="70" oninput="out.value=this.value;">
                        <output for='tm' id="out"></output>
                    </div>
                </form>
            </div>
            <br><br>
            <div class="detalhes">
				<h2>Detalhes do produto</h2>
				<p class="lead"><?php echo $produto->descricao ?></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Característica</th>
                            <th>Detalhe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Modelo</td>
                            <td>Cardigã 7845</td>
                        </tr>
                        <tr>
                            <td>Material</td>
                            <td>Algodão e poliester</td>
                        </tr>
                        <tr>
                            <td>Cores</td>
                            <td>Azul, Rosa e Verde</td>
                        </tr>
                        <tr>	.
                            <td>Lavagem</td>
                            <td>Lavar a mão</td>
                        </tr>  
                    </tbody>			
                </table>
			</div>

            <section id="comentarios">
                <h2><span id="nProd"><?php echo $produto->nome ?></span></h2><br/>
                <article id="coments">
                    <?php
                        $sql = "SELECT * FROM comentarios WHERE id_prod = '$produto->id' ";
                        $r = $bd->query($sql);

                        while($coment = $r->fetch_object()){
                            $data_com = explode(' ',$coment->data_hora);
                            $sql = "SELECT id,nome,foto FROM clientes WHERE id = '$coment->id_cliente' ";
                            $user = $bd->query($sql);
                            $user = $user->fetch_object();
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <img src="img/<?php echo $user->foto ?>" alt="" height="50px">
                        </div>
                        <div class="media-body">
                            <?php 
                                if($coment->id_cliente == $id_u){
                            ?>
                                <h4><?php echo $user->nome."<span class='vc'>Você</span>" ?></h4>
                            <?php }else{
                                ?>
                                <h4><?php echo $user->nome ?></h4>
                                <?php } ?>
                            <p class="conteudo"><?php echo str_replace("\n","<br>\n",$coment->conteudo) ?></p>
                            <?php 
                                $sql2 = "SELECT * FROM comentarios_reacoes WHERE id_comentario = '$coment->id'"; 
                                $num_reacoes = ($bd->query($sql2))->num_rows;
                            ?>
                            <ul class="list-inline" id="com_op">
                                <li><span class="data"><?php echo $data_com[0] ?></span></li>
                                <li><?php echo $data_com[1] ?></li>
                                    <?php 
                                        $sql3 = "SELECT * FROM comentarios_reacoes WHERE id_comentario = '$coment->id' AND id_cliente = '$id_u'"; 
                                        $minhas_reacoes = ($bd->query($sql3))->num_rows;
                                        if($minhas_reacoes > 0){
                                        ?>
                                        <li class="n reagido" data-do='dislikar' data-id-cliente="<?php echo $id_u?>" data-id-comentario="<?php echo $coment->id ?>">gostado</li>
                                <?php 
                                    }else{
                                ?>
                                    <li class="n" data-do='likar' data-id-cliente="<?php echo $id_u ?>" data-id-comentario="<?php echo $coment->id ?>">gostar</li>
                                <?php } ?>
                                <li data-id-comentario="<?php echo $coment->id ?>"><?php echo $num_reacoes ?> <span class="glyphicon glyphicon-thumbs-up"></span></li>
                                <?php 
                                    if($coment->id_cliente == $id_u){
                                ?>
                                    <li class="edita" data-id-comentario="<?php echo $coment->id ?>" data-id-cliente="<?php echo $id_u ?>">editar</li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php 
                        } 
                        if($r->num_rows==0){
                            echo "<div class='msg-vazio'>
                                    <span class='vazio'>Ainda não existe nenhum comentário! <br/> Seja o primeiro a comentar!</span>
                                </div>";
                        }
                    ?>
                </article>

                <article id="comenta">
                    <h4 class="info">Deixe um comentario <span class="fa fa-comment"></span></h4>
                    <form id="form-comenta">
                        <div class="input-group">
                            <textarea name="msg" id="coment" name="conteudo" class="form-control" required></textarea>
                            <button class="btn btn-primary" name="btn-comenta" value="comentar">Comentar</button>
                        </div>
                    </form>
                </article>
            </section>
            <section id="compra">
                <button class="btn btn-info btn-block">Comprar</button>
            </section>
    </main>

    <div class="modal fade" id="modal-checkout">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2">
        <div class="moda-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h3 class="text-center">Editar comentário</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto"><span class="fa fa-edit"></span> Faça as alterações necessárias</label>
                        <textarea name="txt" id="texto" class="form-control" cols="30" rows="10"></textarea>
                        <div class="botoes">
                            <button class="btn btn-outline-info">Atualizar <span class="fa fa-refresh"></span></button>
                            <button class="btn btn-outline-info">Eliminar <span class="fa fa-trash"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="script.js"></script>

    <script>
        $(function(){

            var rCores = $("[name='cor']");

            rCores.click(function(){
                var cor = $("[name='cor']:checked").attr('class');
                var corAt = $('#foto').attr('src');

                if(corAt.includes('rosa')){
                    var nova = corAt.replace('rosa',cor);
                    $('#foto').attr('src',nova); 
                }
                else if(corAt.includes('azul')){
                    var nova = corAt.replace('azul',cor);
                    $('#foto').attr('src',nova); 
                }
                else if(corAt.includes('verde')){
                    var nova = corAt.replace('verde',cor);
                    $('#foto').attr('src',nova); 
                }
            })

            $('#out').val($('#tm').val());

            //abrindo o modal
            $('#compra .btn').click(function(){
                //envia as info do prod via ajax
                $.ajax({
                    url:'modal-checkout.php',
                    type:'get',
                    dataType:'html',
                    data:{
                        'foto':'<?php echo $produto->foto ?>',
                        'nome':'<?php echo $produto->nome ?>',
                        'cor':$('[name=cor]:checked').attr('class'),
                        'tamanho':$('#out').val(),
                        'preco':'<?php echo $produto->preco ?>'
                    }
                }).done(function(data){
                    $('.modal-body').html(data);
                    //abrir o modal com as info enviadas
                    $('#modal-checkout').modal('show');

                });
            })
        //  comentando
        $('#form-comenta').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:'comenta.php',
                type:'post',
                dataType:'html',
                data:{
                    'conteudo':$('#coment').val(),
                    'id_prod':'<?php echo $produto->id?>'
                }
            }).done(function(dados){
                console.log(dados);
                window.location.reload();
            })
        })
        // Like
        $('#com_op .n').click(function(){
            idCliente = $(this).attr('data-id-cliente');
            idComentario = $(this).attr('data-id-comentario');
            ato = $(this).attr('data-do');

            console.log(idCliente,idComentario);
            $.ajax({
                url:'reage_comentario.php',
                type:'post',
                dataType:'html',
                data:{
                    'id_cliente':idCliente,
                    'id_comentario':idComentario,
                    'ato':ato
                }
            }).done(function(dados){
                window.location.reload();
            })
        });
        // mostra lista de quais usuarios reagiram
        $('#com_op li:last-child').mouseenter(function(){
            var elem_atual = $(this);
            idComentario = elem_atual.attr('data-id-comentario');
            $.ajax({
                url:'mostra_reage.php',
                type:'post',
                dataType:'html',
                data:{
                    'id_comentario':idComentario
                }
            }).done(function(dados){
                elem_atual.tooltip({
                    title:dados,
                    html:true,
                    placement:'top',
                    trigger:'click',
                    delay:{show:100,hide:0}
                })
            })
        })
        $('.edita').click(function(){
            idComentario = $(this).attr('data-id-comentario');
            textComentario = $(this).parent().siblings('.conteudo').text();
            $('#modal2 textarea').val(textComentario);
            $('#modal2').modal('show');

            $('#modal2 .btn').click(function(){
                var op;
                var texto = $('#modal2 textarea').val();
                if($(this).text().includes('Atualizar')){
                    // atualizar
                    op = 'atualizar';
                }else{
                    //apagar
                    op = 'apagar';
                }

                $.ajax({
                    url:'editar_comentario.php',
                    type:'post',
                    dataType:'html',
                    data:{
                        'id_comentario':idComentario,
                        'op':op,
                        'texto':texto
                    }
                }).done(function(dados){
                    console.log(dados);
                    window.location.reload();
                })
            })

            console.log(textComentario);

        })
    })
    </script>
</body>
</html>
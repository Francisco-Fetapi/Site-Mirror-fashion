<?php 
    if(!isset($_COOKIE['id_user'])){
        header('location: index.php');
    }

    require 'dados_usuarios.php';
    $bd->select_db('mirror-fashion');
    $qtd_prods = ($bd->query('SELECT * FROM produtos'))->num_rows;
    $id_u = $usuario['id'];
    $qtd_comprados = ($bd->query("SELECT * FROM vendas WHERE id_cliente = '$id_u'"))->num_rows;
    $qtd_desejos = ($bd->query("SELECT * FROM desejos WHERE id_cliente = '$id_u'"))->num_rows;
    $qtd_usuarios = ($bd->query("SELECT * FROM clientes"))->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="bootstrap/css/bootstrap3++++4.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/todos_produtos.css">
    <link rel="stylesheet" href="css/rodape.css">
    <link rel="stylesheet" href="css/estilos2.css">
</head>
<body>

    <?php 
        include_once "views/cabecalho2.php";
        require 'funcoes.php';
    ?>
    
    <aside id="painel">
        <div class="input-group">
            <input type="search" name="q" id="termo" class="form-control" placeholder="Pesquise um produto">
            <span class="input-group-btn"><button class="btn btn-dark" id="btn-search"><span class="fa fa-search"></span></button> </span>
        </div>
        <ul class="list-group">
            <a href="lista_prods.php"><li class="list-group-item ativo" data-tabela="produtos"><span class="fa fa-shopping-cart text-warning"></span>Produtos da Loja <span class="badge"><?php echo $qtd_prods ?></span></li></a>
            <a href="minhas_roupas.php"><li class="list-group-item" data-tabela="vendas"><span class="fa fa-list text-dark"></span>Lista das Minhas Roupas <span class="badge"><?php echo $qtd_comprados ?></span></li></a>
            <a href="meus_desejos.php"><li class="list-group-item" data-tabela="desejos"><span class="fa fa-heart text-danger"></span>Meus desejos<span class="badge"><?php echo $qtd_desejos ?></span></li></a>
            <a href="#"><li class="list-group-item"><span class="fa fa-group text-success"></span>Meus companheiros<span class="badge"><?php echo $qtd_usuarios - 1 ?></span></li></a>
        </ul>
    </aside>
    <main id="listaProd" class="text-center block-center">
        <!-- Aqui vai aparecer dados via ajax-->
    </main>

    <div class="modal fade" id="modal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body bg-danger p-0">
                    <h3 class="text-white text-center m-1"></h3>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'views/rodape.php' ?>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="script.js"></script>

    <script>
        $(function(){
            function modal_erro(msg,tempo){
                $('#modal1 h3').html(msg);
                $('#modal1').modal('show');
                    setTimeout(() => {
                        $('#modal1').modal('hide');
                    }, tempo);
            }
            $('.list-group a').click(function(e){
                e.preventDefault();
                if($(this).attr('href')=="#"){
                    modal_erro("Oops!<br>Ainda não disponivel!",1100);
                }else{
                    $('.list-group a li').removeClass('ativo');
                    $(this).children('li').addClass('ativo');

                    if(window.location.href.includes('#rd')){
                        window.location.href = window.location.href.replace('#rd','');
                    }
                    $('#listaProd').load($(this).attr('href'));
                }
            })

            if(window.location.href.includes('#rd')){
                $('.list-group a li').removeClass('ativo');
                $('.list-group a li:eq(1)').addClass('ativo');
                
                $('#listaProd').load('minhas_roupas.php');
                setTimeout(() => {
                    $('.media:eq(0)').css({
                        transition:'all .7s ease',
                        backgroundColor:'rgb(32, 32, 32)'
                    });
                    $('.media:eq(0) figure').append("<h4 class='comprado'> Comprado Recentemente </h4>")
                }, 1000);
                
            }else{
                $('#listaProd').load('lista_prods.php');
            }

            $('#termo').on('search',function(){
                pesquisar($(this).val());
            })
            $('#btn-search').click(function(){
                pesquisar($('#termo').val());
            })

            function pesquisar(termo){
                if(termo.trim()==""){
                    modal_erro("ERRO!!!<br> Nenhum termo de pesquisa inserido",1700)
                }else if(!isNaN(termo)){
                    modal_erro("ERRO!!! <br> Números não podem ser termos de pesquisa!",1700);
                }
                else{
                    var tabela_alvo = $('.ativo').attr('data-tabela');

                    $.ajax({
                        url:'pesquisar_prod.php',
                        type:'post',
                        dataType:'html',
                        data:{
                            'tabela':tabela_alvo,
                            'termo':termo
                        }
                    }).done(function(dados){
                        $('#listaProd').html(dados);
                        if(dados.includes('script') && !dados.includes('media')){
                            $('main').html("<h3 class='aviso1'>Nenhum resultado correspondente a pesquisa! </h3>");
                        }
                    })
                }
            }
        })
    </script>

</body>
</html>
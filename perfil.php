<?php require_once "dados_usuarios.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Perfil de ".$usuario['nome'] ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<?php
    require_once 'views/cabecalho.php';
?>
        <section class="painel">
            <ul class="list-group">
                <li class="list-group-item"><h3><img src="img/<?php echo $usuario['foto'] ?>" class="img-circle"> <?php echo $usuario['nome'] ?></h3></li>
                <a href="#" class="ativo"><li class="list-group-item">Informações Pessoais <span class="glyphicon glyphicon-user pull-right"></span></li></a>
                <a href="#"><li class="list-group-item">Alterar dados <span class="glyphicon glyphicon-pencil pull-right"></span></li></a>
            </ul>
        </section>
    <main id="principal">
        <!-- Aqui vai aparecer dados que serao carregados via ajax -->
    </main>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="script.js"></script>
    <script>
        $(function(){
            // $(window).resize(function(){
            //     $('main h2').html(window.innerWidth+"px");
            // });
            $('main').load('info_usuario.php');

            $('.painel a').click(function(e){
                e.preventDefault();
                $('.painel a').removeClass('ativo');
                $(this).addClass('ativo');
            });
            $('.painel a:eq(0)').click(function(){
                $('main').load('info_usuario.php'); 
            });
            $('.painel a:eq(1)').click(function(){
                $('main').load('alterar_dados.php'); 
            });

        });
    </script>
</body>
</html>
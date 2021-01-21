<?php
    session_start();
    if(isset($_SESSION['id_usuario'])){
        if($_SESSION['id_usuario']!=''){
            header('location: index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        #tudo{
            max-width:470px;
            margin-top:20vh;
            text-align: center;
            padding:32px;
        }
        .form-group{
            width:85%;
        }
        .btn{
            width:60%;
        }
        #nao-sessao{
            color:gray;
            font-size:16px;
        }
    </style>
</head>
<body class="bg-dark text-white">

    <div id="tudo" class="center">

        <form method="GET" id="form">
            <fieldset style="text-align: left;padding-left:10px;padding-right:10px;">
                <legend class="text-white">Login</legend>

                <div class="form-group">
                    <label for="tel">Numero de Telefone</label>
                    <input type="number" name="tel" class="form-control" id="tel">
                </div>
                <div class="form-group">
                    <label for="pass">Senha</label>
                    <input type="password" name="senha" class="form-control" id="pass">
                </div>
                <input type="submit" value="Entrar" class="btn btn-primary" id='btnLogar' style="margin-left:10%;">
            </fieldset>
        </form>

        <br/>   
        <div id="nao-sessao" class="block-center">
            <span>Não tens uma conta?</span><br/>
            <span><a href="criar-conta.html">Cadastrar-se </a></span>
        </div>
    </div>

    <script src="bootstrap/js/jquery.js"></script>
    <script>

$(function(){

    $('#form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'logar.php',
            type:'get',
            dataType:'html',
            data:{
                'tel':$('#tel').val(),
                'senha':$('#pass').val()
            }
        }).done(function(resposta){
            if(resposta == "erro"){
                window.alert("Os dados estão incorretos!");
            }else{
                window.location.href = "home-page.php";
            }
        });
    });

});
        
    </script>
</body>
</html>
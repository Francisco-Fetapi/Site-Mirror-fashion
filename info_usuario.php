<?php
    require_once "dados_usuarios.php";
?>
<h2>Informações Pessoais <span class="glyphicon glyphicon-user"></span></h2>
<div class="all">
    <h4>Nome: <span class="pull-right"><?php echo $usuario['nome'] ?></span></h4>
    <h4>Email: <span class="pull-right"><?php echo $usuario['email'] ?></span></h4>
    <h4>Genero: <span class="pull-right"><?php  
        if($usuario['genero']=="M"){
            echo "Masculino";
        }else{
            echo "Feminino";
        } ?></span></h4>
    <h4>Telefone: <span class="pull-right"><?php echo $usuario['num_tel'] ?></span></h4>
    <h4>Data de nascimento: <span class="pull-right"><?php echo $usuario['data_nascimento'] ?></span></h4>
</div>
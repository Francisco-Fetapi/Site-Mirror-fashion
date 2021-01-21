<?php
    require_once "dados_usuarios.php";
?>
<h2>Alterar dados <span class="glyphicon glyphicon-pencil"></span></h2>
<form method="post" action="save_alteracao.php" enctype="multipart/form-data" class="all all2">
    <h4>Nome: 
        <span class="pull-right">
            <input type="text" name="nome" class="form-control" id="n" value="<?php echo $usuario['nome'] ?>"></span>
    </h4>
    <h4>Email: 
        <span class="pull-right">
            <input type="text" name="email" class="form-control" id="e" value="<?php echo $usuario['email'] ?>"></span>
    </h4>
    <h4>Genero: 
        <span class="pull-right">
            <?php
                if($usuario['genero']=="M"){
                    echo "<input type='radio' name='genero' id='g1' value='M' checked><label for='g1'>Masculino</label> ";
                    echo "<input type='radio' name='genero' id='g2' value='F'><label for='g2'>Feminino</label>";
                }else{
                    echo "<input type='radio' name='genero' id='g1' value='M'><label for='g1'>Masculino</label>";
                    echo "<input type='radio' name='genero' id='g2' value='F' checked><label for='g2'>Feminino</label> ";
                } ?></span>
    </h4>
    <h4>Telefone: 
        <span class="pull-right">
            <input type="number" name="tel" class="form-control" id="t" value="<?php echo $usuario['num_tel'] ?>"></span>
    </h4>
    <h4>Data de nascimento: 
        <span class="pull-right">
            <input type="date" name="nasc" class="form-control" id="na" value="<?php echo $usuario['data_nascimento'] ?>"></span>
    </h4>
    <h4>Foto de perfil: 
        <span class="pull-right">
            <label for="img">
                <img src="img/<?php echo $usuario['foto']?>" alt="" style="width:80px;height:90px;">
            </label>
            <input type="file" name="foto" size="200" id="img" class="form-control" style="display:none;"></span>
            <input type="hidden" id="mudou" name="fotoMudou">
    </h4>
    <button class="btn btn-primary" id="btnMudar"><span class="glyphicon glyphicon-refresh"></span></button>
</form>
<script>
    $(function(){
        $('#img').on('input',function(){
            $('#mudou').attr('value','sim');
        })
    })
</script>
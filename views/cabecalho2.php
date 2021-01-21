

<?php 
    $qtd_comprados = ($bd->query("SELECT * FROM vendas WHERE id_cliente = '$id_u'"))->num_rows;
?>
<header>
        <img src="img/logo-rodape.png" class="pull-left">
        <ul class="list-inline pull-right">
        <?php 
            if($qtd_comprados == 0){
                echo "<li>Nenhum item na<br/> sacola de compras</li>";
            }else{
        ?>
            <li><b><?php echo $qtd_comprados ?></b> item(s) na<br/> sacola de compras</li>
        <?php } ?>
            <li><img src="img/sacola.png" alt=""></li>
        </ul>
</header>
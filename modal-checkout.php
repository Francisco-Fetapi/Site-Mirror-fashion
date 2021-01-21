<?php

    $foto = $_GET['foto'];
    $nome = $_GET['nome'];
    $cor = $_GET['cor'];
    $tamanho = $_GET['tamanho'];
    $preco = $_GET['preco'];

?>

<main>
    <form action="comprar.php" method="post">
        <div class="panel panel-a">
            <div class="panel-heading">
                <h4 class="panel-title">Sua compra</h4>
            </div>
            <div class="panel-body">
                <div class="thumbnail">
                    <img src="img/produtos/<?php echo "$foto-$cor"?>.png" alt="">
                </div>
                <dl>
                    <dt>Produto</dt>
                        <dd><?php echo $nome?></dd>
                    <dt>Cor</dt>
                        <dd><?php echo $cor?></dd>
                    <dt>Tamanho</dt>
                        <dd><?php echo $tamanho?></dd>
                    <dt>Preço</dt>
                        <dd id="preco"><?php echo $preco ?></dd>
                </dl>
                <button class="btn btn-primary btn-block" id="btnCom">Comprar</button>
            </div>
        </div>
        <fieldset class="div3">
            <legend>Informações da Compra</legend>
            <div class="card1">
                <div class="card-body">
                    
                    <div class="form-group pull-left">
                        <label for="qtd">Quantidade:</label>
                        <input type="number" id="qtd" min="1" max="99" value="1" name='qt' class="form-control">
                    </div>
                    
                    <div class="form-group pull-right">
                        <label for="total">Total:</label>
                        <output id="total" class="form-control"><?php echo $preco ?></output>
                    </div>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="nome" value="<?php  echo $nome ?>">
        <input type="hidden" name="cor" value="<?php  echo $cor ?>">
        <input type="hidden" name="tamanho" value="<?php  echo $tamanho ?>">
        <input type="hidden" name="preco" value="<?php  echo $preco ?>">
        <input type="hidden" name="tot" value="">
    </form>
</main>

<script>
    //calculando o total no modal
    $('#qtd').click(function(){
        var qtd = +$(this).val();
        var preco = $('#preco').text();
        preco = preco.replace('KZ','');
        preco = +preco.replace(',','.');
        
        var total = (qtd * preco).toFixed(2);
        var txtTotal = (total+' KZ').replace('.',',');
        $('#total').val(txtTotal);
        $('[name=tot]').val(txtTotal);
    });
    $('#qtd').change(function(){ //para que o campo nao esteja vazio!
        if($(this).val().trim()==""){
            $(this).val(0);
        }
    })

    $('[name=tot]').val($('#preco').text()); //para que o total seja o preco do produto caso o usuario nao clique em #qtd!
</script>
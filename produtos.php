<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste banco</title>
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.css">
</head>
<body class="bg-dark text-white">
    
    <?php
    
        $bd = new mysqli('localhost','root','','mirror-fashion');
        $sql = "SELECT * FROM produtos";
        $r = $bd->query($sql);

    
    ?>
    <table class="table text-white table-bordered">
        <tr>
            <th>Nome</th>
            <th>Preco</th>
            <th>Descricao</th>
            <th>Datas</th>
            <th>Vendas</th>
        </tr>
        <?php
            while($prods = $r->fetch_object()){
                echo "
                <tr>
                    <td>$prods->nome</td>
                    <td>$prods->preco</td>
                    <td>$prods->descricao</td>
                    <td>$prods->data</td>
                    <td>$prods->vendas</td>
                </tr>
                
                ";
            }
        ?>
    </table>

</body>
</html>
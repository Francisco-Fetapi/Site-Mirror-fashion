<?php

    function existe_no_banco($id_tel,$results){
        $existe = false;
        while($r = $results->fetch_object()){
            if($r->num_tel == $id_tel){
                $existe = true;
            }
        }
        return $existe;
    }

    function user_existe($numero,$senha){
        require "conexao.php";
        $bd->select_db('mirror-fashion');

        $sql = "SELECT * FROM clientes WHERE num_tel = '$numero' AND palavra_passe = '$senha'";
        $results = $bd->query($sql);

        if($results->num_rows > 0){
            return true;    
        }else{
            return false;
        }
    }
    function existe_quanto($num_tel){
        require "conexao.php";
        $bd->select_db('mirror-fashion');

        $sql = "SELECT * FROM clientes WHERE num_tel = '$num_tel'";
        $result = $bd->query($sql);
        $num_linhas = $result->num_rows;

        return $num_linhas;
    }

    function existe_desejo($id_cliente,$id_prod){
        require "conexao.php";
        $bd->select_db('mirror-fashion');

        $sql = "SELECT id_prod FROM desejos WHERE id_cliente = '$id_cliente' AND id_prod = '$id_prod'";
        $qtd = ($bd->query($sql))->num_rows;

        if($qtd > 0){
            return true;
        }else{
            return false;
        }
    }
    function contaDesejos($id_us,$id_prod){
        require "conexao.php";
        $bd->select_db('mirror-fashion');

        $sql = "SELECT * FROM desejos WHERE id_prod = '$id_prod'";
        $qtd = ($bd->query($sql))->num_rows;

        $sql1 = "SELECT * FROM desejos WHERE id_prod = '$id_prod' AND id_cliente = '$id_us'";
        $qtd_eu = ($bd->query($sql1))->num_rows;

        if($qtd == 0){
            return "<b class='b'>Ninguem</b> desejou este produto ainda!";
        }else if($qtd == 1){
            if($qtd_eu > 0){
                return "<b class='b'>Só você</b> desejou este produto";
            }else{
                return "<b class='b'>1 pessoa</b> desejou este produto";
            }
        }else{
            if($qtd_eu > 0){
                $qtd_sem_mim = $qtd -1;
                return "<b class='b'>Você e mais $qtd_sem_mim pessoa(s)</b> desejam comprar este produto";
            }else{
                return "<b class='b'>$qtd pessoas</b> desejam comprar este produto";
            }
        }
    }
    function foi_comprado($id_cliente,$id_prod){
        require 'conexao.php';
        $bd->select_db('mirror-fashion');

        $sql = "SELECT * FROM vendas WHERE id_cliente = '$id_cliente' AND id_prod = '$id_prod'";
        $qtd = ($bd->query($sql))->num_rows;

        if($qtd > 0){
            return true;
        }else{
            return false;
        }
    }
    function destaca_parte($str1,$str2,$nome){
        $novo_nome = str_ireplace($str1,$str2,$nome);
        return $novo_nome;
    }
?>
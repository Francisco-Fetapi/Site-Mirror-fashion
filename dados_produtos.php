<?php

    require_once "conexao.php";
    $bd->select_db('mirror-fashion');
    
    $sql = "SELECT * FROM produtos";
    $dados = $bd->query($sql);
    $produto = array();

    //Guardar info de cada produto num array
    $cont = 1;
    while($r = $dados->fetch_object()){
        $produto[$cont]['id'] = $r->id;
        $produto[$cont]['nome'] = $r->nome;
        $produto[$cont]['preco'] = $r->preco;
        $produto[$cont]['desc'] = $r->descricao;
        $produto[$cont]['data'] = $r->data;
        $produto[$cont]['vendas'] = $r->vendas;
        $produto[$cont]['foto'] = $r->foto;

        $cont++;
    }
    
    $sql = "SELECT * FROM produtos ORDER BY vendas DESC LIMIT 4";
    $dados = $bd->query($sql);
    $mais_vendidos = array();

    $cont = 1;
    while($r = $dados->fetch_object()){
        $mais_vendidos[$cont]['id'] = $r->id;
        $mais_vendidos[$cont]['nome'] = $r->nome;
        $mais_vendidos[$cont]['preco'] = $r->preco;
        $mais_vendidos[$cont]['desc'] = $r->descricao;
        $mais_vendidos[$cont]['data'] = $r->data;
        $mais_vendidos[$cont]['vendas'] = $r->vendas;
        $mais_vendidos[$cont]['foto'] = $r->foto;

        $cont++;
    }


    $sql = "SELECT * FROM produtos ORDER BY data DESC LIMIT 4";
    $dados = $bd->query($sql);
    $novidades = array();

    $cont = 1;
    while($r = $dados->fetch_object()){
        $novidades[$cont]['id'] = $r->id;
        $novidades[$cont]['nome'] = $r->nome;
        $novidades[$cont]['preco'] = $r->preco;
        $novidades[$cont]['desc'] = $r->descricao;
        $novidades[$cont]['data'] = $r->data;
        $novidades[$cont]['vendas'] = $r->vendas;
        $novidades[$cont]['foto'] = $r->foto;

        $cont++;
    }
?>
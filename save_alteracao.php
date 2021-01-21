<?php

    require_once "conexao.php";
    require_once "funcoes.php";
    require "dados_usuarios.php";

    $bd->select_db('mirror-fashion');

    $nome = $_POST['nome'];
    $data_nasc = $_POST['nasc'];
    $genero = $_POST['genero'];
    $num_tel = $_POST['tel'];
    $email = $_POST['email'];
    $foto_mudou = $_POST['fotoMudou'];

        if(isset($foto_mudou)){   
            //nome do arquivo
            $nome_ficheiro = 'foto' . $usuario['id'].'.jpg';
            $endereco_ficheiro = "img/$nome_ficheiro";

            if(move_uploaded_file($_FILES['foto']['tmp_name'],$endereco_ficheiro)){
                echo "Arquivo enviado";
                $sql = "UPDATE clientes SET foto = '$nome_ficheiro' WHERE id = '$usuario[id]'";
                $bd->query($sql);    
            }else{
                echo "Arquivo nao enviado";
            }
            echo "Foto mudada";
        }

    $res = $bd->query('SELECT * FROM clientes');
    if(existe_quanto($num_tel) <= 1 ){ //se apenas existir ele ou ninguem com um numero de telefone igual ao especificado!
        $sql = "UPDATE clientes SET
            nome = '$nome',
            data_de_nascimento = '$data_nasc',
            genero = '$genero',
            num_tel = '$num_tel',
            email = '$email'
            WHERE id = '$usuario[id]'
        ";
        if($bd->query($sql)){
            echo "Dados atualizados";
            $_SESSION['id_usuario'] = $num_tel;
        }else{
            echo "Algo correu mal \n";
            echo $bd->error;
        }
    }else{
        echo "jaExiste ".existe_quanto($num_tel).' usuarios!';//ja existe no banco
    }
    header('location: perfil.php#principal');
?>
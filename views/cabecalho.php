<?php
    require_once "dados_usuarios.php";
?>
<header class="container-fluid">
    <nav class="navbar navbar-default">
        
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#menu" onclick="">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand" id="m">Mirror Fashion</a>
        </div>
        <div class="navbar-collapse collapse pull-right" id="menu">
            <ul class="nav navbar-nav">
                <li><a href="home-page.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                <li><a href="sobre.php"><span class="glyphicon glyphicon-info-sign"></span> Sobre</a></li>
                <li><a href="#" id="btnLogout"><span class="glyphicon glyphicon-log-out"></span> Terminar Sessão</a></li>
            </ul>
            <a href="perfil.php"><ul class="nav navbar-nav userInfo">
                <li><img src="img/<?php echo "$usuario[foto]" ?>" alt=""></li>
                <li><?php echo $usuario['nome']?></li>
            </ul></a>
        </div>
        </nav>
    </header>
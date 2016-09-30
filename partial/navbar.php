<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Gclin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./"><i class="fa fa-home"></i> Home</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php  if(empty($_SESSION['id_usuario'])){ ?>
                        <li><a href="login.php"><i class="fa fa-btn fa-sign-in"></i> Login</a></li>
                        <!--<li><a href="registro.php"><i class="fa fa-btn fa-pencil-square"></i> Registrar</a></li>-->
                <?php } else { ?>
                        <!--<li><a href="registro.php?method=alterar"><i class="fa fa-btn fa-user"></i> Meus dados</a></li>-->
                        <li><a href="addProdutos.php"><i class="fa fa-btn fa-plus"></i> Adicionar Produtos</a></li>
                        <li><a href="produtos.php"><i class="fa fa-btn fa-th-list"></i> Produtos</a></li>
                        <li><a href="?sair"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<?php
include 'partial/header.php';
include 'classes/database.class.php';
include 'classes/usuarios.class.php';
$usuarios = new Usuarios();
if(isset($_GET['method']) && $_GET['method'] == 'alterar') $usuarios->dadosUsuario();
?>
<body>
    <?php include 'partial/navbar.php'; ?>
    <div class="container container-fluid">
        <div class="row">        
            <div class="col-md-8 col-md-offset-2">
                <div id="errors" style="display: none;"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">Registro</div>
                    <div class="panel-body">
                        <form id="formCadastro" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Usuário</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $usuarios->usuario ?>" required="required" maxlength="13">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Senha</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="senha" name="senha" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="hidden" id="method" value="<?php if(isset($_GET['method']) && $_GET['method'] == 'alterar') echo 'alterar' ?>">
                                    <input type="button" id="login" class="btn btn-primary" value="Enviar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<?php include_once 'partial/footer.php' ?>
    <script src="js/registro.js" type="text/javascript"></script>
<?php 
include 'partial/header.php'; 
include 'partial/navbar.php'; 
?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="errors" style="display: none;"></div>
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Usuário</label>
                            <div class="col-md-6">
                                <input type="usuario" class="form-control" id="usuario" name="usuario" value="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Senha</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="senha" id="senha" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <!-- <div class="checkbox">
                                    <label for="">
                                        <input type="checkbox" name="remember">Lembrar-me
                                    </label>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="logar">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                                <!-- <a class="btn btn-link" href="../password/reset">Perdeu a senha?</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partial/footer.php' ?>
<script src="js/login.js" type="text/javascript"></script>
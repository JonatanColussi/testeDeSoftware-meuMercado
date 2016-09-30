<?php 
include 'partial/header.php';
include 'partial/funcoes.php';
include 'partial/autenticacao.php';
require 'classes/database.class.php';
require 'classes/produtos.class.php';
$produtos =  new Produtos();
$btn = 'Cadastrar';
if(isset($_GET['method']) && $_GET['method'] == 'editar'):
    if(is_numeric($_GET['produto'])):
        $produtos->id_produto = $_GET['produto'];
        $produtos->dadosProduto();
        $btn = 'Alterar';
    endif;
endif;
?>
<body>
    <?php include 'partial/navbar.php'; ?>
    <div class="container container-fluid">
        <div class="row">        
            <div class="col-md-8 col-md-offset-2">
                <div id="errors" style="display: none;"></div>
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <?= $btn ?> Produto</div>
                    <div class="panel-body">
                        <form id="formCadastro" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Produto</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="produto" name="produto" maxlength="150" value="<?= $produtos->nome ?>" <?php if($produtos->nome != '') echo 'readonly' ?> required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="tipo" name="tipo" maxlength="150" value="<?= $produtos->tipo ?>" <?php if($produtos->tipo != '') echo 'readonly' ?> required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Valor</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">R$</span>
                                        <input type="number" step="0.01" class="form-control" id="valor" name="valor" maxlength="150" value="<?= $produtos->valor ?>" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Estoque</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="estoque" name="estoque" maxlength="150" value="<?= $produtos->estoque ?>" min="0" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="hidden" name="id" value="<?=$produtos->id_produto ?>">
                                    <input type="submit" class="btn btn-primary" value="<?= $btn ?>"/>
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
<script src="js/addprodutos.js" type="text/javascript"></script>
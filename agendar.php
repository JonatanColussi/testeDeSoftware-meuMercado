<?php 
include 'partial/header.php';
include 'partial/funcoes.php';
include 'partial/autenticacao.php';
require 'classes/database.class.php';
require 'classes/consultas.class.php';
$consultas =  new Consultas();
$btn = 'Agendar';
if(isset($_GET['method']) && $_GET['method'] == 'reagendar'):
    if(is_numeric($_GET['consulta'])):
        $consultas->id = $_GET['consulta'];
        $consultas->dadosConsulta();
        $btn = 'Reagendar';
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
                    <div class="panel-heading"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <?= $btn ?> Consulta</div>
                    <div class="panel-body">
                        <form id="formCadastro" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="paciente" name="paciente" maxlength="150" readonly value="<?=$_SESSION['nome_usuario']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Especialidade:</label>
                                <div class="col-md-6">
                                    <?php include_once 'partial/selectEspecialidades.php'; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Médico</label>
                                <div class="col-md-6 medicos">
                                    <select name="especialidade" id="especialidade" class="form-control" disabled>
                                        <option value="">Primeiramente, selecione uma especialidade</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Data</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control datepicker" id="data" name="data" required="required" maxlength="12" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Horário</label>
                                <div class="col-md-6 horarios">
                                    <select name="horario" id="horario" class="form-control" disabled>
                                        <option value="">Selecione uma data</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="hidden" name="id" value="<?=$consultas->id ?>">
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
<script src="js/agendar.js" type="text/javascript"></script>
<script type="text/javascript" id="dateScript"></script>
<script>
    jQuery(document).ready(function($) {
        <?php if(isset($_GET['method']) && $_GET['method'] == 'reagendar'): ?>
        $("#especialidade").val(<?=$consultas->especialidade ?>);
        loadMedicos(<?=$consultas->especialidade ?>,<?=$consultas->medico ?>);
        $("#data").val("<?=dataExibicao($consultas->data)?>");
        searchHorarios(<?=$consultas->medico ?>,"<?=dataExibicao($consultas->data) ?>");
        <?php endif; ?>
    });
</script>
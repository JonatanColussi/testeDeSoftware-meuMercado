<?php
	require '../classes/database.class.php';
	require '../classes/medicos.class.php';
	$medicos = new Medicos();
	$medicos->id = $_GET['medico'];
	$diasNaoFuncionamento = $medicos->listarDiasNaoFuncionamento();
?>
<script>
	$(function($){
	   $(".datepicker").datepicker('destroy');
	   $(".datepicker").datepicker({
	        format: 'dd/mm/yyyy',
	        language: 'pt-BR',
	        weekStart: 0,
	        startDate:'0d',
	        todayHighlight: true,
	        autoclose: true,
	        daysOfWeekDisabled: [<?php echo implode(',',$diasNaoFuncionamento) ?>]
	    });
	});
</script>
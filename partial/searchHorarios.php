<?php
	require '../classes/database.class.php';
	require '../classes/consultas.class.php';
	include_once 'funcoes.php';
	$consultas = new Consultas();
	$consultas->medico = $_GET['medico'];
	$consultas->data = ($_GET['data'] != '' || $_GET['data'] != null) ? dataBanco($_GET['data']) : null;

	if($_GET['data'] != '' || $_GET['data'] != null){
		echo '<select class="form-control" id="horario" name="horario">';
		echo "\n<option value=\"\">Selecione um horário</option>\n";
		foreach($consultas->horariosLivres() as $horarios){
			echo "<option value=\"$horarios->horario\">".formataHora($horarios->horario)."</option>\n";
		}
		echo '</select>';
	}else{
		echo '<select class="form-control" id="horario" name="horario" disabled>';
		echo "\n<option value=\"\">Escolha uma data</option>\n";
		echo '</select>';
	}
?>
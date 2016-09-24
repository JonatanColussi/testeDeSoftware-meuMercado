<?php
	require '../classes/database.class.php';
	require '../classes/medicos.class.php';
	$medicos = new Medicos();
	$medicos->especialidade = $_GET['especialidade'];
	echo '<select class="form-control" id="medico" name="medico">';
	echo "<option value=\"\">Selecione um médico</option>";
	foreach($medicos->selectMedicos() as $dados){
		if($_GET['medico'] != $dados->id)
			echo "<option value=\"$dados->id\">$dados->nome</option>";
		else
			echo "<option selected value=\"$dados->id\">$dados->nome</option>";
	}
	echo '</select>';
<?php
	require 'classes/especialidades.class.php';
	$especialidades = new Especialidades();
	echo '<select class="form-control" id="especialidade" name="especialidade">';
	echo "<option value=\"\">Selecione uma especialidade</option>";
	foreach($especialidades->allEspecialidades() as $dados){
		echo "<option value=\"$dados->id\">$dados->especialidade</option>";
	}
	echo '</select>';
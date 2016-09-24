<?php
	require '../classes/database.class.php';
	require '../classes/consultas.class.php';
	include_once 'funcoes.php';
	$consultas = new Consultas();
	$consultas->id = isset($_POST['id']) ? $_POST['id'] : null;
	$consultas->medico = isset($_POST['medico']) ? $_POST['medico'] : null;
	$consultas->especialidade = isset($_POST['especialidade']) ? $_POST['especialidade'] : null;
	$consultas->data = isset($_POST['data']) ? dataBanco($_POST['data']) : null;
	$consultas->horarioInicial = isset($_POST['horario']) ? $_POST['horario'] : null;
	if(isset($_POST['horario'])) $horarioTermino = date('H:i:s', strtotime("+30 minute", strtotime($_POST['horario'])));
	$consultas->horarioTermino = isset($_POST['horario']) ? $horarioTermino : null;

	if($consultas->id == null)
		echo $consultas->inserirConsulta();
	else
		echo $consultas->editarConsulta();
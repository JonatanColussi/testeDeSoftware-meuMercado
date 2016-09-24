<?php
	require '../classes/database.class.php';
	require '../classes/consultas.class.php';
	include_once 'funcoes.php';
	$consultas = new Consultas();
	$consultas->id = isset($_GET['consulta']) ? $_GET['consulta'] : null;

	echo $consultas->cancelarConsulta();
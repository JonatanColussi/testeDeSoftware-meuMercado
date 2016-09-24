<?php
	require '../classes/database.class.php';
	require '../classes/produtos.class.php';
	include_once 'funcoes.php';
	$produtos = new Produtos();
	$produtos->id_produto = isset($_POST['id']) ? $_POST['id'] : null;
	$produtos->nome = isset($_POST['produto']) ? $_POST['produto'] : null;
	$produtos->tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
	$produtos->valor = isset($_POST['valor']) ? $_POST['valor'] : null;
	$produtos->estoque = isset($_POST['estoque']) ? $_POST['estoque'] : null;

	if($produtos->id_produto == null)
		echo $produtos->inserirProduto();
	else
		echo $produtos->editarProduto();
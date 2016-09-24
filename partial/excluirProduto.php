<?php
	require '../classes/database.class.php';
	require '../classes/produtos.class.php';
	include_once 'funcoes.php';
	$produtos = new Produtos();
	$produtos->id_produto = isset($_GET['Produto']) ? $_GET['Produto'] : null;

	echo $produtos->excluirProduto();
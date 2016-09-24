<?php
require_once '../classes/database.class.php';
require_once '../classes/usuarios.class.php';
function limpaCaracteres($valor){
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("_", "", $valor);
	$valor = str_replace("/", "", $valor);
	$valor = str_replace("(", "", $valor);
	$valor = str_replace(")", "", $valor);
	return $valor;
}

$usuario = trim(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING));
$senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));

$usuarios = new Usuarios();
$usuarios->usuario = isset($usuario) ? $usuario : null;
$usuarios->senha = isset($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

if($_POST['method'] == 'alterar'):
	echo $usuarios->editarUsuario();
else:
	echo $usuarios->findByusuarioCadastrado($_POST['usuario']);
endif;
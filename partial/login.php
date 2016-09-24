<?php
require_once '../classes/database.class.php';
require_once '../classes/usuarios.class.php';
if(isset($_POST['usuario']) && $_POST['usuario'])
	if(isset($_POST['senha']) && $_POST['senha']):
		$usuarios = new Usuarios();
	if($usuarios->findBylogin($_POST['usuario']) === true)
		echo $usuarios->logar($_POST['senha']);
	endif;
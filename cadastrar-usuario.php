<?php
	header('Content-Type: text/html; charset=UTF-8');
	include "partial/config.php";
	$con = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
	if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
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
	
	$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
	$cpf = trim(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
	$cpf = limpaCaracteres($cpf);
	$telefone = trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING));
	$telefone = limpaCaracteres($telefone);
	$senha = trim($_POST['senha']);

	//$nome = filter_input(INPUT_POST, $nome, FILTER_SANITIZE_STRING);
	//die("o nome é ".$telefone);
	


	/* Vamos checar algum erro nos campos */

	if ((!$nome) || (!$email) || (!$cpf) || (!$telefone) || (!$senha)){
		
		echo "ERRO: <br /><br />";
		
		if (!$nome){
			echo "Nome é um campo requerido.<br />";
		}
		if (!$email){
			echo "Email é um campo requerido.<br /><br />";
		}
		if (!$cpf){
			echo "O CPF é um campo requerido.<br /> <br />";
		}
		if (!$telefone){
			echo "Telefone é um campo requerido.<br /><br />";
		}
		if (!$senha){
			echo "Senha é um campo requerido.<br /><br />";
		}

		echo "Preencha os campos abaixo: <br /><br />";

		include "registro.php";

	}else{

		/* Vamos checar se o nome de Usuário escolhido e/ou Email já existem no banco de dados */
		$sql_email_check = $con->query("SELECT COUNT(id) FROM usuarios WHERE email='{$email}'");
		$sql_usuario_check = $con->query("SELECT COUNT(id) FROM usuarios WHERE nome='{$nome}'");

		$eReg = mysqli_fetch_array($sql_email_check);
		$uReg = mysqli_fetch_array($sql_usuario_check);

		$email_check = $eReg[0];
		$usuario_check = $uReg[0];

		if (($email_check > 0) || ($usuario_check > 0)){
			echo "<strong>ERRO</strong>: <br /><br />";

			if ($email_check > 0){
				echo "Este email já está sendo utilizado.<br /><br />";
				unset($email);
			}

			if ($usuario_check > 0){
				echo "Este nome já está sendo utilizado.<br /><br />";
				unset($nome);
			}

		} else {

			/* Se passarmos por esta verificação ilesos é hora de finalmente cadastrar os dados. 
			Vamos utilizar uma função para gerar o Hash de senha que será salva no banco de dados.*/

			
			$senhaH = password_hash( $senha, PASSWORD_DEFAULT);
			$ativo = "N";
			
			$consulta = "INSERT INTO usuarios (nome, email, telefone, cpf, senha, ativo, criado)
				VALUES ('$nome', '$email', '$telefone', '$cpf', '$senhaH', '$ativo', NOW())";
			
			$sql = $con->query($consulta);

			if (!$sql){

				echo "Ocorreu um erro ao criar sua conta, entre em contato.";
				
			}else{
				
				//die('Chegou no email');
				$usuario_id = mysqli_insert_id($con);

				// Enviar um email ao usuário para confirmação e ativar o cadastro!

				// $headers = "MIME-Version: 1.0\n";
				// $headers .= "Content-type: text/html; charset=iso-8859-1\n";
				// $headers .= "From: Teu Domínio - Webmaster<email@teusite.com.br>";

				// $subject = "Confirmação de cadastro - teusite.com.br";
				// $mensagem = "Prezado {$nome},<br />
				// Obrigado pelo seu cadastro em nosso site, <a href='https://agendar-fininhors.c9users.io/site/'>
				// https://agendar-fininhors.c9users.io/site/</a>!<br /> <br />

				// Para confirmar seu cadastro e ativar sua conta em nosso site, podendo acessar à
				// áreas exclusivas, por favor clique no link abaixo ou copie e cole na barra de
				// endereço do seu navegador.<br /> <br />

				// <a href='https://agendar-fininhors.c9users.io/site/ativar.php?id={$id}&code={$senha}'>
				// 	https://agendar-fininhors.c9users.io/site/ativar.php?id={$id}&code={$senha}
				// </a>

				// <br /> <br />
				// Após a ativação de sua conta, você poderá ter acesso ao conteúdo exclusivo
				// efetuado o login com os seguintes dados abaixo:<br > <br />

				// <strong>Usuario</strong>: {$usuario}<br />
				// <strong>Senha</strong>: {$senha_randomica}<br /> <br />

				// Obrigado!<br /> <br />

				// Webmaster<br /> <br /> <br />
				// Esta é uma mensagem automática, por favor não responda!";

				// mail($email, $subject, $mensagem, $headers);

				echo "Foi enviado para seu email - {$email} um pedido de confirmação de cadastro, por favor verifique e sigas as instruções!";
			}
		}
	}

?>
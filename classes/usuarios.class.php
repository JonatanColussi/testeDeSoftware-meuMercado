<?php
if(!isset($_SESSION)) session_start(); 
class Usuarios{
	public $db;

	private $id;
	private $usuario;
	private $senha;

	function __construct(){
		$db = new Database();
		$this->db = $db->instance();
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}

	public function  __get($atributo){
		return $this->$atributo;
	}

	public function findByusuario($usuario){
		try {
			$query = $this->db->prepare("SELECT usuario, senha FROM usuarios WHERE usuario = :usuario");
			$query->BindValue(':usuario',$usuario, PDO::PARAM_STR);
			$query->Execute();
			if($query->rowCount() > 0){
				$usuario = $query->fetch(PDO::FETCH_OBJ);
				$this->id = $usuario->id_usuario;
				$this->usuario = $usuario->usuario;
				$this->senha = $usuario->senha;
				return true;
			}else{
				throw new Exception('O usuário informado não está cadastrado!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
	public function findByusuarioCadastrado($usuario){
		try {
			$query = $this->db->prepare("SELECT usuario FROM usuarios WHERE usuario = :usuario");
			$query->BindValue(':usuario',$usuario, PDO::PARAM_STR);
			$query->Execute();
			if($query->rowCount() == 0){
				return self::inserirUsuario();
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Este usuario já está cadastrado em nosso sistema</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
		return self::inserirUsuario();
	}
	public function dadosUsuario(){
		try {
			$query = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
			$query->BindValue(':id',$_SESSION['id_usuario'], PDO::PARAM_INT);
			$query->Execute();
			if($query->rowCount() > 0){
				$usuario = $query->fetch(PDO::FETCH_OBJ);
				$this->id = $usuario->id_usuario;
				$this->usuario = $usuario->usuario;
				$this->senha = $usuario->senha;
				return true;
			}else{
				throw new Exception('Não existe o usuário solicitado!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
	public function logar($senha){
		try{
			if(password_verify($senha, $this->senha) === false){
				throw new Exception('Usuário e/ou senha inválidos!');
				echo 'nao logou';
			}else{
				$_SESSION['id_usuario'] = $this->id;
				$_SESSION['usuario_usuario'] = $this->usuario;
				return true;
			}
		}catch(Exception $e) {
			header('HTTP/1.1 401 Unauthorized');
			echo $e->getMessage();
		}
	}

	public function inserirUsuario(){
		try {
			//if(self::validarCpf($this->cpf) == true){
				$query = $this->db->prepare("INSERT INTO usuarios (usuario, senha) VALUES (:usuario, :senha)");
				$query->BindValue(':usuario',$this->usuario, PDO::PARAM_STR);
				$query->BindValue(':senha',$this->senha, PDO::PARAM_STR);
				if($query->Execute()){
					return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Usuário cadastrato com sucesso</strong></div>','inserir'));
				}else{
					return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao cadastrar o usuário</strong></div>','inserir'));
				}
			// }else{
			// 	return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>CPF inválido</strong></div>','inserir'));
			// }
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}	

	public function editarUsuario(){
		try {
			if(self::validarCpf($this->cpf) == true){
				$query = $this->db->prepare("UPDATE usuarios SET usuario = :usuario, senha = :senha WHERE id = :id");
				$query->BindValue(':id',$_SESSION['id_usuario'], PDO::PARAM_INT);
				$query->BindValue(':usuario',$this->usuario, PDO::PARAM_STR);
				$query->BindValue(':senha',$this->senha, PDO::PARAM_STR);
				if($query->Execute()){
					return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Dados alterados com sucesso</strong></div>','editar'));
				}else{
					return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao alterar os dados</strong></div>','editar'));
				}
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>CPF inválido</strong></div>','editar'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function findBylogin($usuario){
		try {
			$query = $this->db->prepare("SELECT id_usuario, usuario, senha FROM usuarios WHERE usuario = :usuario");
			$query->BindValue(':usuario',$usuario, PDO::PARAM_STR);
			$query->Execute();
			if($query->rowCount() > 0){
				$usuario = $query->fetch(PDO::FETCH_OBJ);
				$this->id = $usuario->id_usuario;
				$this->usuario = $usuario->usuario;
				$this->senha = $usuario->senha;
				return true;
			}else{
				throw new Exception('O usuário informado não está cadastrado!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}
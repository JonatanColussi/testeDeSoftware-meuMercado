<?php
if(!isset($_SESSION)) session_start(); 
class Produtos{
	public $db;

	private $id_produto;
	private $nome;
	private $tipo;
	private $valor;
	private $estoque;

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

	public function dadosProduto(){
		try{
			$query = $this->db->prepare("SELECT * FROM produtos WHERE id_produto = :id_produto");
			$query->BindParam(':id_produto',$this->id_produto);
			$query->Execute();
			if($query->rowCount() > 0){
				$dados = $query->fetch(PDO::FETCH_OBJ);
				$this->id_produto = $dados->id_produto;
				$this->nome = $dados->nome;
				$this->tipo = $dados->tipo;
				$this->valor = $dados->valor;
				$this->estoque = $dados->estoque;
				return true;
			}else{
				throw new Exception('A produto não foi encontrada!!');
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}


	public function inserirProduto(){
		try {
			$query = $this->db->prepare("INSERT INTO produtos (nome, tipo, valor, estoque) VALUES (:nome, :tipo, :valor, :estoque)");
			if(!strpos($this->valor, '.')) $this->valor .= '.00';
			$query->BindParam(':nome',$this->nome);
			$query->BindParam(':tipo',$this->tipo);
			$query->BindParam(':valor',$this->valor);
			$query->BindParam(':estoque',$this->estoque);

			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Produto cadastrado com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao cadastrar o produto</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}	

	public function editarProduto(){
		try {
			$query = $this->db->prepare("UPDATE produtos SET id_produto = :id_produto, nome = :nome, tipo = :tipo, valor = :valor, estoque = :estoque WHERE id_produto = :id_produto");
			if(!strpos($this->valor, '.')) $this->valor .= '.00';
			$query->BindParam(':id_produto',$this->id_produto);
			$query->BindParam(':nome',$this->nome);
			$query->BindParam(':tipo',$this->tipo);
			$query->BindParam(':valor',$this->valor);
			$query->BindParam(':estoque',$this->estoque);

			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Produto alterado com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao alterar o produto</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function listProdutos(){
		try {
			// $query = $this->db->prepare("SELECT 
			// 								*
			// 							FROM
			// 								produtos c 
			// 								INNER JOIN
			// 									medicos m 
			// 										ON m.id_produto = c.medico
			// 								INNER JOIN
			// 									especialid_produtoades e
			// 										ON e.id_produto = c.especialid_produtoade
			// 							WHERE 
			// 								c.paciente = :paciente AND
			// 								c.ativo = 'S'");
			$query = $this->db->prepare("SELECT 
											*
										FROM
											produtos");
			// $query->BindParam(':paciente',$this->paciente);
			$query->Execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			}else{
				throw new Exception('<div class="alert alert-danger"><strong>Não há produtos cadastrados!!</strong></div>');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function excluirProduto(){
		try {
			$query = $this->db->prepare("DELETE FROM produtos WHERE id_produto = :id_produto");
			$query->BindParam(':id_produto',$this->id_produto);
			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Produto excluido com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao excluir o produto</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}
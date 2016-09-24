<?php
class Medicos{
	public $db;

	private $id;
	private $crm;
	private $cpf;
	private $especialidade;
	private $telefone;
	private $celular;
	private $nome;

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

	public function dadosMedico(){
		try{
			$query = $this->db->prepare("SELECT * FROM medicos WHERE id = :id");
			$query->BindParam(':id',$this->id);
			$query->Execute();
			if($query->rowCount() > 0){
				$dados-> $query->fetch(PDO::FETCH_OBJ);
				$this->id = $dados->id;
				$this->crm = $dados->crm;
				$this->cpf = $dados->cpf;
				$this->especialidade = $dados->especialidade;
				$this->telefone = $dados->telefone;
				$this->celular = $dados->celular;
				$this->nome = $dados->nome;
				return true;
			}else{
				throw new Exception('O médico não foi encontrado!!');
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function selectMedicos(){
		try {;
			$query = $this->db->prepare("SELECT id, nome FROM medicos WHERE especialidade = :especialidade AND ativo = 'S'");
			$query->BindParam(':especialidade',$this->especialidade);
			$query->Execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			}else{
				throw new Exception('Nenhum Médico vinculado à essa especialidade!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}	

	function listarDiasNaoFuncionamento(){
		try{
    		$query = $this->db->prepare("SELECT dia FROM medicosxdias WHERE medico = :medico");
        	$query->BindParam(':medico',$this->id);
			$query->Execute();
			if($query->rowCount() > 0){
				$diasFuncionamento = array();
				foreach($query->fetchAll(PDO::FETCH_OBJ) as $dia){
					array_push($diasFuncionamento, $dia->dia);
				}
				$diasBloqueados = array();
			    for($i=0;$i<=6;$i++){
			        if(!in_array($i,$diasFuncionamento)){
			            array_push($diasBloqueados, $i);
			        }
			    }
			    return $diasBloqueados;
			}else{
				throw new Exception('Nenhum Médico vinculado à essa especialidade!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
    }
}
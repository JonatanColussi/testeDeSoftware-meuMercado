<?php
if(!isset($_SESSION)) session_start(); 
class Consultas{
	public $db;

	private $id;
	private $paciente;
	private $medico;
	private $especialidade;
	private $data;
	private $horarioInicial;
	private $horarioTermino;
	private $ativo;

	function __construct(){
		$db = new Database();
		$this->db = $db->instance();
		$this->paciente = $_SESSION['id_usuario'];
	}

	public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function  __get($atributo){
        return $this->$atributo;
    }

	public function dadosConsulta(){
		try{
			$query = $this->db->prepare("SELECT * FROM consultas WHERE id = :id");
			$query->BindParam(':id',$this->id);
			$query->Execute();
			if($query->rowCount() > 0){
				$dados = $query->fetch(PDO::FETCH_OBJ);
				$this->id = $dados->id;
				$this->paciente = $dados->paciente;
				$this->medico = $dados->medico;
				$this->especialidade = $dados->especialidade;
				$this->data = $dados->data;
				$this->horarioInicial = $dados->horarioInicial;
				$this->horarioTermino = $dados->horarioTermino;
				$this->ativo = $dados->ativo;
				return true;
			}else{
				throw new Exception('A consulta não foi encontrada!!');
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function horariosLivres(){
		try {
			date_default_timezone_set('America/Sao_Paulo');
	        if($this->data == date('Y-m-d')) $horaAtual = date('H:i:s');
	        else $horaAtual = '';
			$query = $this->db->prepare("SELECT h.horario FROM medicosxhorarios h
					                    WHERE h.horario NOT IN (
					                        SELECT h.horario FROM medicosxhorarios h, consultas c 
					                        WHERE h.horario = c.horarioInicial 
					                        AND c.medico = :medico
					                        AND c.data = :data
					                        AND c.ativo = 'S') 

					                    AND h.horario NOT IN(
					                        SELECT h.horario FROM medicosxhorarios h, consultas c 
					                        WHERE h.horario > c.horarioInicial 
					                        AND h.horario < c.horarioTermino  
					                        AND c.medico = :medico 
					                        AND c.data = :data
					                        AND c.ativo = 'S')

					                    AND h.medico = :medico
					                    AND h.horario >= :horaAtual
					                    GROUP BY h.horario");
			$query->BindParam(':medico',$this->medico);
			$query->BindParam(':horaAtual',$horaAtual);
			$query->BindParam(':data',$this->data);
			$query->Execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			}else{
				throw new Exception('Não há horarios disponíveis!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function inserirConsulta(){
		try {
			$query = $this->db->prepare("INSERT INTO consultas (paciente, medico, especialidade, data, horarioInicial, horarioTermino, criado, ativo) VALUES (:paciente, :medico, :especialidade, :data, :horarioInicial, :horarioTermino, NOW(), 'S')");
			$query->BindParam(':paciente',$this->paciente);
			$query->BindParam(':medico',$this->medico);
			$query->BindParam(':especialidade',$this->especialidade);
			$query->BindParam(':data',$this->data);
			$query->BindParam(':horarioInicial',$this->horarioInicial);
			$query->BindParam(':horarioTermino',$this->horarioTermino);
			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Consulta agendada com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao agendar a consulta</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}	

	public function editarConsulta(){
		try {
			$query = $this->db->prepare("UPDATE consultas SET paciente = :paciente, medico = :medico, especialidade = :especialidade, data = :data, horarioInicial = :horarioInicial, horarioTermino = :horarioTermino, modificado = NOW() WHERE id = :id");
			$query->BindParam(':id',$this->id);
			$query->BindParam(':paciente',$this->paciente);
			$query->BindParam(':medico',$this->medico);
			$query->BindParam(':especialidade',$this->especialidade);
			$query->BindParam(':data',$this->data);
			$query->BindParam(':horarioInicial',$this->horarioInicial);
			$query->BindParam(':horarioTermino',$this->horarioTermino);
			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Consulta reagendada com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao reagendar a consulta</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function listConsultas(){
		try {
			$query = $this->db->prepare("SELECT 
											c.id,
											c.data,
											c.horarioInicial,
											m.nome as medico,
											e.especialidade
										FROM
											consultas c 
											INNER JOIN
												medicos m 
													ON m.id = c.medico
											INNER JOIN
												especialidades e
													ON e.id = c.especialidade
										WHERE 
											c.paciente = :paciente AND
											c.ativo = 'S'");
			$query->BindParam(':paciente',$this->paciente);
			$query->Execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			}else{
				throw new Exception('<div class="alert alert-danger"><strong>Não há consultas marcadas!!</strong></div>');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function cancelarConsulta(){
		try {
			$query = $this->db->prepare("UPDATE consultas SET ativo = 'N', modificado = NOW() WHERE id = :id");
			$query->BindParam(':id',$this->id);
			if($query->Execute()){
				return json_encode(array(true,'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Consulta cancelada com sucesso</strong></div>'));
			}else{
				return json_encode(array(false,'<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Houve um erro ao cancelar a consulta</strong></div>'));
			}
		}catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}
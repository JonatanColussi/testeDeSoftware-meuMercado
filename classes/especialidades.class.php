<?php
class Especialidades{
	public $db;

	private $id;
	private $espacialidade;

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

	public function allEspecialidades(){
		try {
			$query = $this->db->prepare("SELECT id, especialidade FROM especialidades WHERE ativo = 'S'");
			$query->Execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
				// return $query;
			}else{
				throw new Exception('Nenhuma especialidade cadastrada!!');
			}
		}catch(Exception $e) {
			echo $e->getMessage();
		}
	}	
}
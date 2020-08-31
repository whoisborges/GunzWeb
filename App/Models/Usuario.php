<?php

namespace APP\Models;

use MF\Model\Model;

class Usuario extends Model{

	private $userid;
	private $name;
	private $email;
	private $password;
	private $confirmpassword;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}

	// Salvar
	public function save(){
		$query = "insert into Account(UserID, UGradeID, PGradeID, RegDate, Name, Email)values(:userid, 0, 0, GETDATE(), :name, :email)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':userid', $this->__get('userid'));
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		$sql = "SELECT AID FROM ACCOUNT WHERE UserID = :userid";
		$statement = $this->db->prepare($sql);
		$statement->bindValue(':userid', $this->__get('userid'));
		$statement->execute();
		$result = $statement->fetch(\PDO::FETCH_ASSOC);
		$aid = $result['AID'];

		$insert = "INSERT INTO LOGIN(UserID, AID, Password) VALUES (:userid, :aid, :password)";
		$stmt2 = $this->db->prepare($insert);
		$stmt2->bindValue(':userid', $this->__get('userid'));
		$stmt2->bindParam(':aid', $aid);
		$stmt2->bindValue(':password', $this->__get('password'));
		$stmt2->execute();

		return $this;
	}

	// validação básica

	public function validate(){
	$valido = true;

	if(strlen($this->__get('userid')) < 4){
		$valido = false;
	}

	if(strlen($this->__get('name')) < 4){
		$valido = false;
	}

	if(strlen($this->__get('email')) < 4){
		$valido = false;
	}

	if(strlen($this->__get('password')) < 4){
		$valido = false;
	}
	if($this->__get('password') != $this->__get('confirmpassword')){
		$valido = false;
	}

	return $valido;
}

	
	public function getUsuarioPorUserID() {
		$query = "select userid, email from Account where userid = :userid";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':userid', $this->__get('userid'));
		$stmt->execute();
	
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


}


?>
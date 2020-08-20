<?php

class object {

	public $table;
	public $db ;
	public function search($params = array(),$params_query = array()){
		$conditions ="1 = 1";
		if(isset($params["conditions"]))
			$conditions = $params["conditions"];
		$limit ="";
		if(isset($params["limit"]))
			$limit = $params["limit"];
		$fields ="*";
		if(isset($params["fields"]))
			$fields = $params["fields"];
		$req =$this->db->prepare("SELECT $fields FROM $this->table WHERE $conditions $limit");
		if(isset($params_query) and !empty($params_query)){
			 $req->execute($params_query);
			 $resultat = array();
			 while ($val = $req->fetch(PDO::FETCH_ASSOC)) {
			 	array_push( $resultat, $val );
			 }
			return $resultat;
		}else{
			 $req->execute();
			 $resultat = array();
			 while ($val = $req->fetch(PDO::FETCH_ASSOC)) {
			 	array_push( $resultat, $val );
			 }
			return $resultat;
		}


	}

	public function insert($params = array()){
		$query = "INSERT INTO $this->table values('', ";
		$params_query = array();
		foreach ($params as $key => $value) {
			$query .=" ?,";
			array_push($params_query,$value);
		}
		$query = Substr($query , 0, strlen($query) - 1);
		$query .= " )";
		$req = $this->db->prepare($query);
		$rest = $req->execute($params_query);
		return $rest;
		//var_dump($req);die();
	}

	public function update($params = array(),$conditions){
		$query = "UPDATE  $this->table SET ";
		$params_query = array();
		foreach ($params as $key => $value) {
			$query .=" $key = ?,";
			array_push($params_query,$value);
		}
		$query = Substr($query , 0, strlen($query) - 1);
		$query .= " WHERE $conditions";
		//var_dump($query);die();
		$req = $this->db->prepare($query);
		$rest = $req->execute($params_query);
		return $rest;
	}

	public function delete($conditions){
		$query = "DELETE from $this->table where $conditions";
		//echo $query;die();
		$req = $this->db->prepare($query);
		$rest = $req->execute();
		return $rest;
	}
}
<?php

class Staff{
	//database connection and table name

private $conn;
private $table_name="staff";

//object properties
public $staffcode;
public $name;
public $gender;
public $designation;


public function __construct($db){
	$this->conn=$db;
}

//create user
function create(){
	//write query

	try{

	$this->autogen();	
	$query="INSERT INTO ".$this->table_name. "(staffcode,name,gender,designation) values(?,?,?,?)";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->staffcode);
	$stmt->bindParam(2,$this->name);
	$stmt->bindParam(3,$this->gender);
	$stmt->bindParam(4,$this->designation);
	

 	if($stmt->execute()){
		return "success";
	}
	else{
		return "fail";
	}
}
catch(Exception $ex){
	return $ex.errorMessage();
}
}


//autogeneration
function autogen(){
	$query="select count(staffcode) as c, max(staffcode) as m from ".$this->table_name;
	$stmt=$this->conn->prepare($query);
	$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$this->countrows=$row['c'];
	if($this->countrows==0)
		$this->staffcode=1;
	else{
		$this->staffcode=$row['m'];
		$this->staffcode++;
	}
}


//select all data
function readAll(){
	$query="SELECT * FROM ". $this->table_name;
	
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

}
?>
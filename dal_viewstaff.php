<?php 

	 
	 	include_once 'database.php';
		include_once 'staff.php';

		$database = new Database();
		$db = $database->getConnection();

		$staff = new Staff($db);
		$result=$staff->readAll();

		$data=array();
		
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{
			array_push($data,$row);
			 
		}
		echo json_encode($data);

	?>
	 
<?php
include_once 'database.php';
include_once 'staff.php';

$database = new Database();
$db = $database->getConnection();
$staff = new Staff($db);
$msg="";
 
    try{
    	if (empty($_POST["param_name"])) {
            $msg = " Username is required ";
        }
        else
        {
             $staff->name=$_POST["param_name"];    
        }   	
    	$staff->gender=$_POST["param_gender"];
        
        $staff->designation=$_POST["param_designation"];

        if(empty($msg))
        {


        if($staff->create()){
            $msg="Success";
           
        }
    // if unable to create , tell the user
    else{
         $msg= "Unable";
        }
         echo json_encode($msg);
    }
    else
    {
    	 echo json_encode($msg);
    }
    }
    catch(Exception $ex)
    {
        $msg=$ex.errorMessage();
    }
    finally{
        //echo $msg;
    }
 
?>

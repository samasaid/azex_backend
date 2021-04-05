<?php
// include headers
    header("Access-Control-Allow-Origin: *");
    // it allow all origins like  localhost, any domain or sub-domain 
    header("Access-Control-Allow-Methods: GET");
    // method type
    // ***************------------------------------------------***************
    // include database.php
    include_once ("../config/database.php");
    //include student.php
    include_once ("../classes/AboutTheTeam.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from student class

    $aboutTheTeam = new AboutTheTeam($connection);

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $param = isset($_GET['id'])? $_GET['id']:"";
        if(!empty($param)){
            $aboutTheTeam->id = $param;
            if($aboutTheTeam->delete_date_of_team()){
                http_response_code(200); //ok
                echo json_encode(array(
                "status"=>1,
                "data"=>"record is deleted"
            ));
            }else{
                http_response_code(500); 
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"record does not delete"
                ));
            }
        
        }else{
             http_response_code(404); 
             echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
             ));
             }
        }else{
        http_response_code(503); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }



 ?>
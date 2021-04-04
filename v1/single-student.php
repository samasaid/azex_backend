<?php
// include headers
    header("Access-Control-Allow-Origin: *");
    // it allow all origins like  localhost, any domain or sub-domain 
    header("Content-Type: application/json; charset=UTF-8");
    // data which we are getting inside request
    header("Access-Control-Allow-Methods: POST");
    // method type
    // ***************------------------------------------------***************
    // include database.php
    include_once ("../config/database.php");
    //include student.php
    include_once ("../classes/student.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from student class

    $stud = new Student($connection);

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $param = json_decode(file_get_contents('php://input'));
        if(!empty($param->stud_id)){
            $stud->stud_id = $param->stud_id;
            $stud_data = $stud->get_stud_data();
            if(!empty($stud_data)){
                http_response_code(200); //ok
                echo json_encode(array(
                "status"=>1,
                "data"=>$stud_data
            ));
            }else{
                http_response_code(500); //ok
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"fail"
                ));
            }
        
        }else{
             http_response_code(404); //ok
             echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
             ));
             }
        }else{
        http_response_code(503); //ok
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }



 ?>
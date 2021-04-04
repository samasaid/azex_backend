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
    include_once ("../classes/student.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from student class

    $stud = new Student($connection);

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $param = isset($_GET['stud_id'])? intval($_GET['stud_id']):"";
        if(!empty($param)){
            $stud->stud_id = $param;
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
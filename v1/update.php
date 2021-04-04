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
    require_once ("../config/database.php");
    //include student.php
    require_once ("../classes/student.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from student class

    $stud = new Student($connection);

    if($_SERVER['REQUEST_METHOD']==='POST'){
        //submit data
        $data = json_decode(file_get_contents('php://input'));
       if(!empty($data->name) && !empty($data->email) && !empty($data->mobile) && !empty($data->stud_id)){
        $stud->name = $data->name;
        $stud->email = $data->email;
        $stud->mobile = $data->mobile;
        $stud->stud_id = $data->stud_id;

        if($stud->update_data()){
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "messege"=>"success student updated"
            ));
        }else{
            http_response_code(500); //ok
            echo json_encode(array(
                "status"=>0,
                "messege"=>"fail student update"
            ));
        }
    }else{
        http_response_code(404); //ok
        echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
        ));
    }}else{
        http_response_code(503); //ok
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }
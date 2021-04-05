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
    require_once ("../classes/AboutTheTeam.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from student class

    $aboutTheTeam  = new AboutTheTeam($connection);

    if($_SERVER['REQUEST_METHOD']==='POST'){
        //submit data
        $data = json_decode(file_get_contents('php://input'));
       if(!empty($data->about_the_team) && !empty($data->team_vision) && !empty($data->team_messege)){
        $aboutTheTeam ->about_the_team = $data->about_the_team;
        $aboutTheTeam ->team_vision = $data->team_vision;
        $aboutTheTeam ->team_messege = $data->team_messege;

        if($aboutTheTeam->update_about_the_team_data()){
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "messege"=>"success recorde is updated"
            ));
        }else{
            http_response_code(500); 
            echo json_encode(array(
                "status"=>0,
                "messege"=>"fail record update"
            ));
        }
    }else{
        http_response_code(404); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
        ));
    }}else{
        http_response_code(503); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }
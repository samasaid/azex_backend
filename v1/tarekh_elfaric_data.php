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
        $data = $aboutTheTeam->get_date_of_team_data();
        if($data->num_rows>0){
            $about['records']=array();
            while($row = $data->fetch_assoc()){
                array_push($about['records'],array(
                    'id'=>$row['id'],
                    'year'=>$row['year'],
                    'description'=>$row['description'],

                ));
            }
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "data"=>$about['records']
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
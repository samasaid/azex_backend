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
        $data = $stud->get_all_data();
        if($data->num_rows>0){
            $studs['records']=array();
            while($row = $data->fetch_assoc()){
                array_push($studs['records'],array(
                    'id'=>$row['stud_id'],
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                    'mobile'=>$row['mobile'],
                    'stauts'=>$row['stauts'],
                    'created_at'=>date("d-m-y",strtotime($row['created_at']))

                ));
            }
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "data"=>$studs['records']
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
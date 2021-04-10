<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// get database connection
include_once '../../classes/database.php';
  
// instantiate ending class
include_once '../../classes/ending.php';


// instantiate database and ending object
  
$database = new Database();

$db = $database->getConnection();
  
$ending = new ending($db);
  

// query products
$stmt = $ending->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $ending_arr=array();
    $ending_arr["records"]=array();
  
    // retrieve our table contents

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $ending_item=array(
            "title" => $title,
            "article" => $article,
            
        );
  
        array_push($ending_arr["records"], $ending_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($ending_arr);
}
  else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No articles found.")
    );
}
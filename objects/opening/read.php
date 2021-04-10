<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// get database connection
include_once '../../classes/database.php';
  
// instantiate Opening class
include_once '../../classes/Opening.php';


// instantiate database and opening object
  
$database = new Database();

$db = $database->getConnection();
  
$opening = new Opening($db);
  

// query products
$stmt = $opening->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $opening_arr=array();
    $opening_arr["records"]=array();
  
    // retrieve our table contents

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $opening_item=array(
            "title" => $title,
            "article" => $article,
            
        );
  
        array_push($opening_arr["records"], $opening_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($opening_arr);
}
  else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No articles found.")
    );
}
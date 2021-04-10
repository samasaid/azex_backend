<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../classes/database.php';
  
// instantiate ending class
include_once '../../classes/ending.php';
  
$database = new Database();

$db = $database->getConnection();
  
$ending = new ending($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$ending->id = $data->id;
  
// set product property values
$ending->title = $data->title;
$ending->article = $data->article;


// update the product
if($ending->update()){
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Articale was updated."));
}
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Articale."));
}
?>
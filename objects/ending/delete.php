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
  
// get ending id
$data = json_decode(file_get_contents("php://input"));

// set ending id to be deleted
$ending->id = $data->id;
  
// delete the ending
if($ending->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "ending was deleted."));
}
  
// if unable to delete the ending
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete ending."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../classes/database.php';
  
// instantiate Opening class
include_once '../../classes/Opening.php';
  
$database = new Database();

$db = $database->getConnection();
  
$opening = new Opening($db);
  
// get opening id
$data = json_decode(file_get_contents("php://input"));

// set opening id to be deleted
$opening->id = $data->id;
  
// delete the opening
if($opening->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "opening was deleted."));
}
  
// if unable to delete the opening
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete opening."));
}
?>
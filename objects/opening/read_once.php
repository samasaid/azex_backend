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
  
// set ID property of record to read
$opening->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of opening to be edited
$opening->readOne();
  
if($opening->title != null){
    // create array
    $opening_arr = array(
        "id" =>  $opening->id,
        "title" => $opening->title,
        "article" => $opening->article
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($opening_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user opening does not exist
    echo json_encode(array("message" => "opening does not exist."));
}
?>
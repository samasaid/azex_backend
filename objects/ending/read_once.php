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
  
// set ID property of record to read
$ending->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of ending to be edited
$ending->readOne();
  
if($ending->title != null){
    // create array
    $ending_arr = array(
        "id" =>  $ending->id,
        "title" => $ending->title,
        "article" => $ending->article
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($ending_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user ending does not exist
    echo json_encode(array("message" => "ending does not exist."));
}
?>
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
  
// get posted data
$data = json_decode(file_get_contents("php://input"));


// make sure data is not empty
if(
    !empty($data->title) &&
    !empty($data->article)
){
  
    // set product property values
    $opening->title   = $data->title;
    $opening->article = $data->article;
  
    // create the product
    if($opening->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Your article was created successfully"));
    }
  
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create article."));
    }
}
  
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create article. Data is incomplete."));
}
?>

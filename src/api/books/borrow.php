<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/book.php';
include_once '../shared/utilities.php';

$utilities = new Utilities();

$utilities->checkMethod();
$token = $utilities->getBearerToken();
$test = $utilities->checkToken($token);
if($test == false){
    http_response_code(401);
 
    echo json_encode(array("message" => "Token invalide."));
    
    exit();
}
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare book object
$book = new Book($db);
 
// get id of book to be edited
$data = json_decode(file_get_contents("php://input"));


 
// make sure data is not empty
if(
    !empty($data->idUser) &&
    !empty($data->idBook)
){
    // set ID property of book to be edited
    $book->id = $data->idBook;
    
    // update the book
    if($book->borrow($data->idUser)){
    
        // set response code - 200 ok
        http_response_code(200);
    
        // tell the user
        echo json_encode(array("message" => "Livre emprunté."));
    }
    // if unable to update the book, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Impossible d'emprunter le livre."));
    }
}
else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Impossible d'emprunter le livre, informations imcomplètes."));
}
?>
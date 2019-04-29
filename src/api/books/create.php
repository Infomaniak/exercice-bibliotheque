<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
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
 
$database = new Database();
$db = $database->getConnection();
 
$book = new Book($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->titre) &&
    !empty($data->auteur) &&
    !empty($data->genre) &&
    !empty($data->type) &&
    !empty($data->date) &&
    !empty($data->dispo)
){
 
    // set book property values
    $book->titre = $data->titre;
    $book->auteur = $data->auteur;
    $book->genre = $data->genre;
    $book->type = $data->type;
    $book->date = $data->date;
    $book->dispo = ($data->dispo == 'FALSE') ? 0 : 1;
 
    // create the book
    if($book->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Livre créé."));
    }
 
    // if unable to create the book, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Impossible de créer un livre."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Impossible de créer un livre, informations manquantes."));
}
?>
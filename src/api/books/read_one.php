<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
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
 
// set ID property of book to read
$book->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of book to be edited
$book->readOne();
 
if($book->titre != null){
    // create array
    $book_arr = array(
        "id" =>  $book->id,
        "titre" => $book->titre,
        "auteur" => $book->auteur,
        "genre" => $book->genre,
        "type" => $book->type,
        "date" => $book->date,
        "dispo" => $book->dispo
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($book_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user book does not exist
    echo json_encode(array("message" => "Livre inexistant."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

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

// get database
$database = new Database();
$db = $database->getConnection();
 
// get book object
$book = new Book($db);

// get ID of user
$idUser = isset($_GET['id']) ? $_GET['id'] : die();

// query
$stmt = $book->readBorrowed($idUser);
$num = $stmt->rowCount();

if($num>0){
 
    // array of result
    $books_arr = array();
    $books_arr["books"] = array();
 
    // fetch all books
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $book_item = array(
            "id" => $id,
            "titre" => $titre,
            "auteur" => $auteur,
            "genre" => $genre,
            "type" => $type,
            "date" => $date,
            "dispo" => $dispo
        );
 
        array_push($books_arr["books"], $book_item);
    }

    // ok
    http_response_code(200);
 
    echo json_encode($books_arr);
} else {
    // no books found
    http_response_code(200);
 
    echo json_encode(
        array("message" => "Aucun livre trouvé.")
    );
}
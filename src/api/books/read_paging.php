<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/book.php';

$utilities = new Utilities();

$utilities->checkMethod();
$token = $utilities->getBearerToken();
$test = $utilities->checkToken($token);
if($test == false){
    http_response_code(401);
 
    echo json_encode(array("message" => "Token invalide."));
    
    exit();
}
 
// instantiate database and book object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$book = new Book($db);
 
// query books
$stmt = $book->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // books array
    $books_arr = array();
    $books_arr["books"] = array();
    $books_arr["paging"] = array();
 
    // retrieve our table contents
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
 
 
    // include paging
    $total_rows = $book->count();
    $page_url = "{$home_url}book/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $books_arr["paging"] = $paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($books_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user books does not exist
    echo json_encode(
        array("message" => "Aucun livre trouvé.")
    );
}
?>
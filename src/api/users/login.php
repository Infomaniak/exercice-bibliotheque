<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../shared/utilities.php';

$utilities = new Utilities();

$utilities->checkMethod();

// get database
$database = new Database();
$db = $database->getConnection();
 
// get user object
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->username) &&
    !empty($data->password)
) {
    // set user property values
    $user->username = $data->username;
    $user->password = $data->password;

    if($user->login()){
        
        require_once('../shared/jwt.php');

        // create token
        $array = array();
        $array['userId'] = $user->id;
        $array['nbf'] = $nbf;
        $array['exp'] = $exp;
        $token = JWT::encode($array, $serverKey);

        // create array
        $user_arr = array(
            "id" =>  $user->id,
            "username" => $user->username,
            "prenom" => $user->prenom,
            "nom" => $user->nom,
            "type" => $user->type,
            "token" => $token
        );

        // set response code - 200 OK
        http_response_code(200);

        // make it json format
        echo json_encode($user_arr);
    } else {
        // set reponse code - 404 user not found
        http_response_code(404);
 
        echo json_encode(
            array("message" => "Informations incorrectes.")
        );
    }
}
else {
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Login impossible, informations manquantes."));
}
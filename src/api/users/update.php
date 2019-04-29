<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../shared/utilities.php';

$utilities = new Utilities();

$utilities->checkMethod();
$token = $utilities->getBearerToken();
$test = $utilities->checkToken($token);
if($token == false){
    http_response_code(401);
 
    echo json_encode(array("message" => "Token invalide."));
}
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
 
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));


 
// make sure data is not empty
if(
    !empty($data->username) &&
    !empty($data->oldpassword) &&
    !empty($data->newpassword) &&
    !empty($data->prenom) &&
    !empty($data->nom)
){
    // set ID property of user to be edited
    $user->id = $data->id;
    
    // check for old password
    $user->username = $data->username;
    $user->password = $data->oldpassword;

    if($user->login()){
        $user->password = $data->newpassword;
        $user->prenom = $data->prenom;
        $user->nom = $data->nom;
        
        // update the user
        if($user->update()){
        
            // set response code - 200 ok
            http_response_code(200);
        
            // tell the user
            echo json_encode(array("message" => "Utilisateur modifié."));
        }
        // if unable to update user, tell the user
        else{
        
            // set response code - 503 service unavailable
            http_response_code(503);
        
            // tell the user
            echo json_encode(array("message" => "Impossible de modifier l'utilisateur."));
        }
    }
    else {
        // set response code - 400 bad request
        http_response_code(400);

        echo json_encode(array("message" => "Ancien mot de passe incorrect."));
    }
}
else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Impossible de modifier l'utilisateur, informations imcomplètes."));
}
?>
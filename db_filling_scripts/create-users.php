<?php
namespace Library\db_filling_scripts;

require_once __DIR__.'/../src/Controllers/user.php';
use function Library\Controllers\create_user;

function create_users (){
    $users = array();
    foreach (range(0, 19) as $index) {
        $users[$index] = create_user("Userfirst".$index, "Userlast","user".$index."@gmail.com",
            "123"); // password is encrypted in "Library\Models\User\setPassword"
    }
    return $users;
}

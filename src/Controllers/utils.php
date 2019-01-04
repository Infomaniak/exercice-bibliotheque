<?php
namespace Library\Controllers;

function dialogBox_and_redirect($message, $pageChange = null){
    if($pageChange != null) {
        echo "<script type='text/javascript'> 
                alert(\"$message\");
                window.location.replace(\"$pageChange\"); 
              </script>";
    }
    else{
        echo "<script type='text/javascript'> 
                alert(\"$message\");
              </script>";
    }
}
<?php
require 'header.php';
print_r($_SESSION);
?>


<form method="post" action="../Controllers/session.php" class="log_out" >
    <button type="submit" name="submit" value="log_out">Log out</button>
</form>
<?php
// show error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
// home page url
$home_url="http://localhost/api/";

$serverKey = "e049f217f5314d6e9e14c09b63ad9558";
$nbf = time();
$exp = new DateTime();
$exp->add(new DateInterval('PT1H'));
$exp = $exp->getTimeStamp();
 
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
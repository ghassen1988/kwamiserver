
<?php
/*
 *  simple HttpRequest example using PHP
 *  tom slankard
 *"http://109.74.196.162/html/test/GetEventByCategory.php"
 */


$json = file_get_contents('http://109.74.196.162/html/test/GetEventByCategory.php');
$data = json_decode($json,true);
echo $data[0]['title'];
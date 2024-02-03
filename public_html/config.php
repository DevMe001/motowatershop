<?php
$servername ="matoswater.shop";
$username ="matoswater";
$password ="matoswater.shop";
$dbname ="shop_db";

$conn = new mysqli($servername,$username,$password,$dbname);

if (!$conn) {
    echo "Connection Failed";
}


?>
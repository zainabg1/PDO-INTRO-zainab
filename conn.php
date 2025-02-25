<?php
$host = "localhost";
$user = "root"; 
$dbname = "winkel";
$pass = "";

try {
     $pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
     echo "Connectie gemaakt!";
} 
catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}
 
?>
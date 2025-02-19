<?php
$host = 'localhost3306';
$db   = 'winkel';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db"; 

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected to database ($db)";
} catch (PDOException $e) {
    die("Verbindingsfout: " . $e->getMessage());
}
?>

<?php
$host = 'localhost';
$dbname = 'dwes_t3_rpg_distancia';
$username = 'root';
$password = '';

try{
    $db = new PDO("mysql:host=$host;dbname=$dbname;charsert=utf8", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e){
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
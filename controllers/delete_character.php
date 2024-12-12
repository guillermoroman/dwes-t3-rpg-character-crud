<?php
require_once("../config/db.php");
require_once("../model/Character.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['id']) || empty($_POST['id'])){
        die ("no se ha recibido un ID");
    }

    try {
        // Borrar
        if (Character::delete($db, $_POST['id'])){
            header ('Location: ../views/create_character.php');
            exit;
        } else {
            "Error al borrar";
        }

        
    } catch (PDOException $e) {
        echo "Error al borrar de la base de datos: " . $e->getMessage();
    }

} else {
    die("Método no permitido");
}
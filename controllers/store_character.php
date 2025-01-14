<?php

require_once("../config/db.php");
require_once("../model/Character.php");


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ( !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])){
        die("Solicitud inválida");
    }


    // Crear objeto Character
    $character = new Character($db);

    // Subir la imagen
    if (isset($_FILES['image'])){

        $uploadDir = '../resources/';
        $fileName = $_FILES['image']['name'];
        $targetFile = $uploadDir . $fileName;
        //print_r($targetFile);

        //print_r($_FILES);
        
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
            //$imageFileName = $fileName;

            $character->setImage($targetFile);
        } else {
            die("Error al subir la imagen");
        }
        
    }

    // Poblar el personaje
    $character->setName($_POST['name'])
        ->setdescription($_POST['description'])
        ->setHealth($_POST['health'])
        ->setStrength($_POST['strength'])
        ->setDefense($_POST['defense'])
        ->setUserId($_SESSION['user_id']);

    // Guardar el Character en la base de datos
    if ($character->save()){
        header ('Location: ../views/create_character.php');
    } else  {
        echo "Error al guardar el personaje";
    }
}
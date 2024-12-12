<?php

require_once("../config/db.php");
require_once("../model/Character.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Crear objeto Character
    $character = new Character($db);
    $character->setId($_POST['id'])
        ->setName($_POST['name'])
        ->setdescription($_POST['description'])
        ->setHealth($_POST['health'])
        ->setStrength($_POST['strength'])
        ->setDefense($_POST['defense'])
        ->setImage($_POST['image']);

        

    // Actualizar el Character en la base de datos
    if ($character->update()){
        header ('Location: ../views/create_character.php');
    } else  {
        echo "Error al actualizar el personaje";
    }
}
    
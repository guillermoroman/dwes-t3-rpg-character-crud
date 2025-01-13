<?php

require_once("../config/db.php");
require_once("../model/Character.php");

session_start();

if (!isset($_SESSION['user_id'])){
    die("Debes iniciar sesión para acceder a esta página.");
} else {
    echo $_SESSION['message'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Crear objeto Character
    $character = new Character($db);

    // Subir la imagen
    if (isset($_FILES['image'])){

        $uploadDir = '../resources/';
        $fileName = $_FILES['image']['name'];
        $targetFile = $uploadDir . $fileName;
        print_r($targetFile);

        print_r($_FILES);
        
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
        echo  "Se ha guardado el personaje";
    } else  {
        echo "Error al guardar el personaje";
    }
}

$characters = [];

try {
    $stmt = $db->query("SELECT characters.*, users.username
    FROM characters
    JOIN users ON characters.user_id = users.id");
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al leer de la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .character-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Crea tu personaje</h1>
    <form action = <?=$_SERVER['PHP_SELF']?> method="POST" enctype="multipart/form-data">
        <label for="nameInput">Nombre:</label>
        <input type="text" name = "name" id = "nameInput" required>
        <br>

        <label for="descriptionInput">Descripción:</label>
        <input type="text" name = "description" id = "descriptionInput" required>
        <br>

        <label for="healthInput">Puntos de vida:</label>
        <input type="number" name = "health" value="100" min="1
        " id = "healthInput" required>
        <br>

        <label for="strengthInput">Fuerza:</label>
        <input type="number" name = "strength" value="10" min="1
        "id = "strengthInput" required>
        <br>

        <label for="defenseInput">Defensa:</label>
        <input type="number" name = "defense" value="10" min="1
        "id = "defenseInput" required>
        <br>

        <label for="imageInput">Imagen:</label>
        <input type="file" name = "image" id = "imageInput" required>
        <br>

        <button type="submit">Crear personaje</button>

    
    </form>

    <h1>Personajes</h1>

    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>PV</th>
                <th>Fuerza</th>
                <th>Defensa</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characters as $character): ?>
                <tr>
                    <td>
                        <img src="../resources/<?= $character['image']?>" alt="Imagen del personaje" class="character-image">
                    </td>
                    <td><?= htmlspecialchars($character['name'])?></td>
                    <td><?= htmlspecialchars($character['description'])?></td>
                    <td><?= htmlspecialchars($character['health'])?></td>
                    <td><?= htmlspecialchars($character['strength'])?></td>
                    <td><?= htmlspecialchars($character['defense'])?></td>
                    <td><?= htmlspecialchars($character['username'])?></td>

                    <td>
                        <?php if ($character['user_id'] == $_SESSION['user_id']):?>
                        <form action = "../controllers/delete_character.php" method = 'POST'>
                            <input type = "hidden" name = "id" value="<?= $character['id']?>">
                            <button type="submit">Borrar</button>
                        </form>

                        <form action = "../views/edit_character.php" method = 'GET'>
                            <input type = "hidden" name = "id" value="<?= $character['id']?>">
                            <button type="submit">Editar</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
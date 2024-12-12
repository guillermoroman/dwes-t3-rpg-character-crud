<?php
require_once("../config/db.php");
require_once("../model/Character.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset ($_GET['id'])){
    try {
        $stmt = $db->prepare("SELECT * FROM characters WHERE id = :id");
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $character = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo "Error al leer de la base de datos: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Edita tu personaje</h1>
    <form action = <?="../controllers/update_character.php"?> method="POST">
        <label for="nameInput">Nombre:</label>
        <input
            type="text"
            name = "name"
            id = "nameInput"
            value = "<?=htmlspecialchars($character['name'])?>"
            required>
        <br>

        <label for="descriptionInput">Descripción:</label>
    <input 
        type="text" 
        name="description" 
        id="descriptionInput" 
        value="<?=htmlspecialchars($character['description'])?>" 
        required>
    <br>

    <label for="healthInput">Puntos de vida:</label>
    <input 
        type="number" 
        name="health" 
        id="healthInput" 
        value="<?=htmlspecialchars($character['health'])?>" 
        min="1" 
        required>
    <br>

    <label for="strengthInput">Fuerza:</label>
    <input 
        type="number" 
        name="strength" 
        id="strengthInput" 
        value="<?=htmlspecialchars($character['strength'])?>" 
        min="1" 
        required>
    <br>

    <label for="defenseInput">Defensa:</label>
    <input 
        type="number" 
        name="defense" 
        id="defenseInput" 
        value="<?=htmlspecialchars($character['defense'])?>" 
        min="1" 
        required>
    <br>

    <label for="imageInput">Imagen:</label>
    <input 
        type="text" 
        name="image" 
        id="imageInput" 
        value="<?=htmlspecialchars($character['image'])?>" 
        required>
    <br>

    <input 
        type="hidden" 
        name="id" 
        value="<?=$_GET['id']?>" 
        required>
    <br>

        <button type="submit">Actualizar personaje</button>

    
    </form>

    <a href="../views/create_character.php">Volver a crear personaje</a>
    
</body>
</html>
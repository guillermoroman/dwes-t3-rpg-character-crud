<?php
require_once("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)){
        die("El nombre de usuario y la contraseña son obligatorios");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try{
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindValue(':username', $userName);
        $stmt->bindValue(':password', $hashedPassword);
        if($stmt->execute()){
            session_start();
            $_SESSION['user_id'] = $db->lastInsertId();
            $_SESSION['username'] = $userName;
            $_SESSION['message'] = "¡Bienvenido por primera vez, $userName";
            header('Location: ../views/create_character.php');
            exit;
        }


    } catch ( PDOException $e) {
        die("Error al registrar el usuario: " . $e->getMessage());
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)){
        die("El nombre de usuario y la contraseña son obligatorios");
    }

    try{
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', $userName);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['message'] = "¡Bienvenido, $username";
            header('Location: ../views/create_character.php');
            exit;
        } else {
            echo "Usuario o contraseña incorrectos";
        }

    } catch ( PDOException $e) {
        die("Error al iniciar sesión: " . $e->getMessage());
    }
}
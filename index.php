<h1>Bienvenido</h1>
<form action="controllers/auth.php" method="POST">
    <h2>Registro</h2>
    <input type="text" name="username" placeholder="Nombre de usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" name="register">Registrar</button>
</form>

<form action="controllers/auth.php" method="POST">
    <h2>Iniciar sesión</h2>
    <input type="text" name="username" placeholder="Nombre de usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" name="login">Iniciar sesión</button>
</form>
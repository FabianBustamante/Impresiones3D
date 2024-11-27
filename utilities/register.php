<?php
include 'utilities/db_connect.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        $success = "Registro completado. Ahora puedes iniciar sesión.";
    } else {
        $error = "Error al registrarse. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registro</title>
</head>
<body>
    <header>
        <h1>Registro</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="name" placeholder="Nombre Completo" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="register">Registrarse</button>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </main>
</body>
</html>

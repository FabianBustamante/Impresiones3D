<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

include '../utilities/db_connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        $success = "Administrador registrado correctamente.";
    } else {
        $error = "Error al registrar el administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registrar Administrador</title>
</head>
<body>
    <header>
        <h1>Registrar Administrador</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="username" placeholder="Nombre de Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="register">Registrar</button>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </main>
</body>
</html>

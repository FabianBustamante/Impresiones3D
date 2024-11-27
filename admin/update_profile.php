<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

include '../utilities/db_connect.php';

$username = $_SESSION['admin_username'];

if (isset($_POST['update'])) {
    $new_username = $_POST['username'];
    $new_password = md5($_POST['password']);

    $query = "UPDATE admins SET username = '$new_username', password = '$new_password' WHERE username = '$username'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['admin_username'] = $new_username;
        $success = "Perfil actualizado correctamente.";
    } else {
        $error = "Error al actualizar el perfil.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Actualizar Perfil</title>
</head>
<body>
    <header>
        <h1>Actualizar Perfil</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="username" placeholder="Nuevo Nombre de Usuario" required>
            <input type="password" name="password" placeholder="Nueva Contraseña" required>
            <button type="submit" name="update">Actualizar</button>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </main>
</body>
</html>

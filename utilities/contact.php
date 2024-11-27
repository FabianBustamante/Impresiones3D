<?php
include 'utilities/db_connect.php';

if (isset($_POST['send_message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $query)) {
        $success = "Mensaje enviado correctamente.";
    } else {
        $error = "Error al enviar el mensaje.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Contacto</title>
</head>
<body>
    <header>
        <h1>Contacto</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <textarea name="message" placeholder="Mensaje" required></textarea>
            <button type="submit" name="send_message">Enviar</button>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </main>
</body>
</html>

<?php
include 'utilities/db_connect.php';

$username = 'admin'; // Nombre de usuario del administrador
$password = '123';  // Cambia esto por una contraseña segura
$hashed_password = password_hash($password, PASSWORD_DEFAULT);  // Cifra la contraseña

// Insertar el usuario admin en la base de datos
$query = "INSERT INTO admins (username, password) VALUES ('$username', '$hashed_password')";
if (mysqli_query($conn, $query)) {
    echo "Administrador creado exitosamente.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

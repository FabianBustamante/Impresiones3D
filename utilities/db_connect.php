<?php
// Configuración de conexión
$host = "localhost";  // Servidor de base de datos (por defecto es localhost)
$username = "root";   // Nombre de usuario de la base de datos (por defecto es root)
$password = "";       // Contraseña (por defecto en XAMPP está vacía)
$database = "shop";   // Nombre de la base de datos

// Crear la conexión
$conn = mysqli_connect($host, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>

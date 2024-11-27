<?php
// Incluir la conexión a la base de datos
include 'utilities/db_connect.php';

// Verificar si el usuario ya está logueado, en ese caso redirigir a la página de inicio
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Consulta para verificar el admin
    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Crear sesión para el usuario admin
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'admin'; // Indicamos que es un admin

            // Redirigir al panel de administración
            header('Location: admin/dashboard.php');
            exit();
        } else {
            $error = "Credenciales incorrectas.";
        }
    } else {
        $error = "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Tienda de Impresiones 3D</h1>
        </div>
    </header>

    <main>
        <section class="login-form">
            <h2>Iniciar Sesión</h2>
            <?php
            if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            ?>
            <form action="login.php" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Tienda de Impresiones 3D. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

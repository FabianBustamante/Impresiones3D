<?php
session_start();
include 'utilities/db_connect.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

if (isset($_POST['place_order'])) {
    $customer_name = $_POST['customer_name'];
    $total = array_sum(array_column($_SESSION['cart'], 'price'));
    $order_date = date('Y-m-d H:i:s');

    $query = "INSERT INTO orders (customer_name, total, order_date, status) VALUES ('$customer_name', '$total', '$order_date', 'Pendiente')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['cart'] = [];
        $success = "Pedido realizado correctamente.";
    } else {
        $error = "Error al realizar el pedido.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Finalizar Compra</title>
</head>
<body>
    <header>
        <h1>Finalizar Compra</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="customer_name" placeholder="Nombre Completo" required>
            <button type="submit" name="place_order">Realizar Pedido</button>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </main>
</body>
</html>

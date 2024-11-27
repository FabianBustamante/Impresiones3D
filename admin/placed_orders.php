<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

include '../utilities/db_connect.php';

// Obtener pedidos
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Pedidos Realizados</title>
</head>
<body>
    <header>
        <h1>Gestión de Pedidos</h1>
    </header>
    <main>
        <section class="orders-list">
            <h2>Lista de Pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td>$<?= number_format($row['total'], 2) ?></td>
                            <td><?= $row['status'] ?></td>
                            <td><?= $row['order_date'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="mark_shipped">Marcar como Enviado</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>

<?php
// Actualizar estado del pedido
if (isset($_POST['mark_shipped'])) {
    $order_id = $_POST['order_id'];
    mysqli_query($conn, "UPDATE orders SET status = 'Enviado' WHERE id = $order_id");
    header("Location: placed_orders.php");
    exit;
}
?>

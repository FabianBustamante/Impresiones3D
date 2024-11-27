<?php
include '../utilities/db_connect.php';

$search_query = "";
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $products = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search_query%' OR category LIKE '%$search_query%'");
} else {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Buscar Productos</title>
</head>
<body>
    <header>
        <h1>Buscar Productos</h1>
    </header>
    <main>
        <form method="get">
            <input type="text" name="query" placeholder="Buscar por nombre o categoría" value="<?= $search_query ?>">
            <button type="submit">Buscar</button>
        </form>

        <section class="search-results">
            <h2>Resultados de la Búsqueda</h2>
            <?php if (!empty($search_query)): ?>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($products)): ?>
                        <li><?= $row['name'] ?> - $<?= number_format($row['price'], 2) ?> (<?= $row['category'] ?>)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No se han encontrado resultados.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

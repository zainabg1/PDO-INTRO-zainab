<?php
require 'db.php';

$producten = $pdo->query("SELECT * FROM producten");
$result = $producten->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h2>Overzicht Producten</h2>
<table class="table table-striped">
    <tr>
        <th>Product code</th>
        <th>Product naam</th>
        <th>Prijs per stuk</th>
        <th>Omschrijving</th>
        <th>Action</th>
        <td>
    </tr>


    <?php
    
    foreach($result as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['product_code']) ?></td>
            <td><?= htmlspecialchars($product['product_naam']) ?></td>
            <td>€<?= number_format($product['prijs_per_stuk'], 2) ?></td>
            <td><?= htmlspecialchars($product['omschrijving']) ?></td>
            <td>
                <a href="edit.php?id=<?= $product['product_code'] ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="delete.php?id=<?= $product['product_code'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
} ?>

</table>
</body>
</html>


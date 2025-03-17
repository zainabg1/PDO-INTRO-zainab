<?php
require 'db.php';

if (isset($_GET['id'])) {
    $product_code = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM producten WHERE product_code = :product_code");
    $stmt->execute(['product_code' => $product_code]);
    $product = $stmt->fetch();

    if (!$product) {
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST['knop'])) {
    $product_naam = $_POST['product_naam'];
    $prijs_per_stuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];

    try {
        $sql = "UPDATE producten SET product_naam = :product_naam, prijs_per_stuk = :prijs_per_stuk, omschrijving = :omschrijving WHERE product_code = :product_code";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            'product_naam' => $product_naam,
            'prijs_per_stuk' => $prijs_per_stuk,
            'omschrijving' => $omschrijving,
            'product_code' => $product_code
        ]);

        if ($stmt->rowCount()) {
            echo "Product succesvol bijgewerkt!";
        } else {
            echo "Er is iets mis gegaan bij het bijwerken van het product.";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bijwerken</title>
</head>
<body>
    <h2>Product Bijwerken</h2>
    <form method="POST">
        Product Naam: <input type="text" name="product_naam" value="<?= htmlspecialchars($product['product_naam']) ?>" required><br>
        Prijs per Stuk: <input type="number" step="0.01" name="prijs_per_stuk" value="<?= htmlspecialchars($product['prijs_per_stuk']) ?>" required><br>
        Omschrijving: <input type="text" name="omschrijving" value="<?= htmlspecialchars($product['omschrijving']) ?>" required><br>
        <button type="submit" name="knop">Update</button>
    </form>
</body>
</html>


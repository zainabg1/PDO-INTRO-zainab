<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_naam = trim($_POST['product_naam']);
    $prijs_per_stuk = trim($_POST['prijs_per_stuk']);
    $omschrijving = trim($_POST['omschrijving']);

    // Server-side validatie
    if (empty($product_naam) || empty($prijs_per_stuk) || empty($omschrijving)) {
        $error = "Alle velden zijn verplicht.";
    } elseif (!is_numeric($prijs_per_stuk) || $prijs_per_stuk <= 0) {
        $error = "Prijs moet een positief getal zijn.";
    } else {
        $stmt = $conn->prepare("INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $product_naam, $prijs_per_stuk, $omschrijving);
        
        if ($stmt->execute()) {
            $success = "Product succesvol toegevoegd!";
        } else {
            $error = "Fout bij toevoegen product.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
</head>
<body>
    <h2>Product toevoegen</h2>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <form method="POST">
        <label>Product Naam:</label>
        <input type="text" name="product_naam" required><br>
        <label>Prijs per Stuk:</label>
        <input type="number" name="prijs_per_stuk" step="0.01" min="0.01" required><br>
        <label>Omschrijving:</label>
        <textarea name="omschrijving" required></textarea><br>
        <button type="submit">Toevoegen</button>
    </form>
</body>
</html>

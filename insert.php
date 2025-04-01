<?php
require "db.php";

if (isset($_POST['knop'])) {
    $product_naam = $_POST['product_naam'];
    $prijs_per_stuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];
    $categorie = $_POST['categorie']; // Nieuwe categorie veld

    $sql = "INSERT INTO Producten (product_naam, prijs_per_stuk, omschrijving, Categorie) 
            VALUES (:product_naam, :prijs_per_stuk, :omschrijving, :categorie)";
    $stmt = $pdo->prepare($sql);
   
    $stmt->execute([
        "product_naam" => $product_naam,
        "prijs_per_stuk" => $prijs_per_stuk,
        "omschrijving" => $omschrijving,
        "categorie" => $categorie
    ]);

    echo "Product toegevoegd!";
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
    <form method="POST">
        Product naam: <input type="text" name="product_naam" required><br>
        Prijs per stuk: <input type="text" name="prijs_per_stuk" required><br>
        Omschrijving: <input type="text" name="omschrijving" required><br>
        
        Categorie:
        <select name="categorie" required>
            <option value="drinken">Drinken</option>
            <option value="eten">Eten</option>
            <option value="kleding">Kleding</option>
            <option value="electronica">Elektronica</option>
        </select><br>

        <button type="submit" name="knop">Toevoegen</button>
    </form>
</body>
</html>

 
 

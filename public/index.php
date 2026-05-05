<?php
// LOGICA PHP
require_once "../config/database.php";

// Preparazione ed esecuzione query per mostrare dati di CONTATTI
try {
    $stmt = $pdo->prepare("SELECT * FROM `contatti`");
    $stmt->execute();

    $contatti = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Errore";
}
?>

<!--HTML-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Rubrica</title>
</head>

<body>


    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-journal-bookmark"></i> Rubrica</a>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        foreach ($contatti as $contatto) {
            echo "{$contatto['nome']} {$contatto['cognome']}";
        }
        ?>
        <div>
            <a href="create.php" class="btn btn-primary"><i class="bi bi-person-add"></i>Add</a>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
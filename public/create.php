<?php
require_once "../config/database.php";

// Preparazione ed esecuzione query per mostrare dati di CATEGORIE
try {
    $stmt = $pdo->prepare("SELECT * FROM `categorie`");
    $stmt->execute();

    $categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Errore";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO contatti(nome, cognome, email, telefono, categoria_id)
                            VALUES (:nome, :cognome, :email, :telefono, :categoria_id)"); // Preparare la query d'inserimento con i segnaposto nominali
    $stmt->execute([
        ':nome' => $_POST['nome'],
        ':cognome' => $_POST['cognome'],
        ':email' => $_POST['email'],
        ':telefono' => $_POST['telefono'],
        ':categoria_id' => $_POST['categoria']
    ]);
    // Una volta eseguita la query, reindirizza alla pagina principale
    header('Location: index.php');
    exit;
} else {
    echo "Mostra il form"; // A cosa serve ?
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Form di registrazione contatto</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h1 class="card-title mb-4 text-center">
                            Form di Registrazione Utente Rubrica
                        </h1>
                        <form id="registrazioneForm" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="nome" id="name" class="form-control" placeholder="Inserisci il nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="cognome" class="form-label">Cognome</label>
                                <input type="text" name="cognome" id="surname" class="form-control" placeholder="Inserisci il cognome" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Inserisci la tua E-mail" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" name="telefono" id="cell" class="form-control" placeholder="Inserisci il numero di cellulare" required>
                            </div>

                            <div class="mb-3">
                                <select name="categoria" id="categoria" class="form-select" aria-label="Default select example">
                                    <?php foreach ($categorie as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>">
                                            <?= $categoria['nome'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-80 mt-3">
                                <i class="bi bi-person-plus"></i> Salva Contatto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
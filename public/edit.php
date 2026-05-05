<?php
require_once "../config/database.php";

// Controllo e validazione dell'ID
$contattoSelezionato = null;

try {
    if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
        $stmt = $pdo->prepare("SELECT * FROM `contatti` WHERE ID=:id");
        $stmt->execute([
            ':id' => $_GET['id']
        ]);

        $contattoSelezionato = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Errore, l'id selezionato è inesistente";
}

// Lettura della categoria
try {
    $stmt = $pdo->prepare("SELECT * FROM `categorie`");
    $stmt->execute();

    $categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Errore";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE contatti SET 
                                nome = :nome,
                                cognome = :cognome,
                                email = :email,
                                telefono = :telefono,
                                categoria_id = :categoria_id
                            WHERE id =:id
                            ");
    $stmt->execute([
        ':id' => $_GET['id'],
        ':nome' => $_POST['nome'],
        ':cognome' => $_POST['cognome'],
        ':email' => $_POST['email'],
        ':telefono' => $_POST['telefono'],
        ':categoria_id' => $_POST['categoria']
    ]);

    header('Location: index.php');
    exit;
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Modifica Contatto</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-journal-bookmark"></i> Rubrica</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card-shadow-lg">
                    <div class="card-body">
                        <h1 class="card-title mb-4 text-center">Modifca Contatto</h1>
                        <form id="modificaContatto" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="nome" id="name" class="form-control" value="<?= $contattoSelezionato['nome'] ?>">

                                <label for="cognome" class="form-label">Cognome</label>
                                <input type="text" name="cognome" id="cognome" class="form-control" value="<?= $contattoSelezionato['cognome'] ?>">

                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value=" <?= $contattoSelezionato['email'] ?>">

                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" value="<?= $contattoSelezionato['telefono'] ?>">

                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select name="categoria" id="categoria" class="form-select">
                                        <?php foreach ($categorie as $categoria): ?>
                                            <option
                                                value="<?= $categoria['id'] ?>"
                                                <?= $categoria['id'] == $contattoSelezionato['categoria_id'] ? 'selected' : '' ?>>
                                                <?= $categoria['nome'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <a href="index.php" class="btn btn-danger">Torna indietro</a>

                                <button type="submit" class="btn btn-primary w-80 mx-2">
                                    <i class="bi bi-person-plus"></i> Salva Modifiche
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
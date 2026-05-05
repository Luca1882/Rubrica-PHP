<?php

require_once '../config/database.php';

// Controllo e validazione dell'ID
$contattoSelezionato = null;

try {
    if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
        $stmt = $pdo->prepare("DELETE FROM contatti WHERE id=:id");
        $stmt->execute([
            ':id' => $_GET['id']
        ]);
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    echo "Errore, l'id selezionato è inesistente";
}

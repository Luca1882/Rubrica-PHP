<?php
// Utilizzo della funzione parse_ini_file per restituire un array delle credenziali di accesso
$env = parse_ini_file(__DIR__ . '/../.env');

// Adesso costruisco il mio db in maniera dinamica
$dsn = "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']}";

try {
    // Connessione...
    $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
}

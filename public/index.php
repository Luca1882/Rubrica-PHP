<?php
    // LOGICA PHP
    require_once "../config/database.php";

    // Preparazione ed esecuzione query per mostrare dati di CONTATTI
    try {
        $stmt = $pdo->prepare("SELECT * FROM `contatti`");
        $stmt->execute();
        
        $contatti = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo"Errore";
    }
?>

    <!--HTML-->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rubrica</title>
    </head>
    <body>
        <?php
            foreach($contatti as $contatto) {
                echo "{$contatto['nome']} {$contatto['cognome']}";
            } 
        ?>
    </body>
    </html>
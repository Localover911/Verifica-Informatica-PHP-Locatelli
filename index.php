<?php
session_start();

// Se non è loggato, reindirizza al login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Verifica Locatelli Gym</title>
</head>
<body>
    <a href="?logout=true" class="logout-btn">Logout</a>
    
    <h1>Gestione Palestra</h1>
    <ul>
        <h3>
            <li><a href="aggiungi_iscritto.php">Aggiungi iscritto</a></li>
        </h3>
    </ul>
</body>
</html>
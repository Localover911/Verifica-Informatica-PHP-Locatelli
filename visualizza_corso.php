<?php
include 'config.php';

$sql = "
    SELECT 
        istruttori.nome AS nome_istruttore,
        corsi.nome AS nome_corso,
        MAX(iscritti.numero_iscritti) AS numero_iscritti
    FROM  istruttori 
    WHERE istruttori.id = corsi.id_istruttore and corsi.id = iscritti.id_corso
    GROUP BY istruttori.id
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Istruttore</th><th>Corso</th><th>Numero Iscritti</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome_istruttore']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome_corso']) . "</td>";
        echo "<td>" . htmlspecialchars($row['numero_iscritti']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nessun risultato trovato.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Corsi</title>
</head>
<body>
    <h1>Elenco Corsi e Istruttori</h1>
    <?php include 'Untitled-2'; ?>
</body>
</html>
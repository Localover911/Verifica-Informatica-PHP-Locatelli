<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data_di_nascita = $_POST['data_di_nascita'];
    $id_corso = $_POST['id_corso'];

    $stmt = $pdo->prepare("INSERT INTO iscritti (nome, cognome, data_di_nascita, id_corso) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $cognome, $data_di_nascita, $id_corso]);
    echo "Nuovo iscritto aggiunto con successo!";
}

$corsi = $pdo->query("SELECT * FROM corsi")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Iscritto</title>
</head>
<body>
    <h1>Aggiungi Iscritto</h1>
    <form method="post">
        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Cognome: <input type="text" name="cognome" required></label><br>
        <label>Data di Nascita: <input type="date" name="data_di_nascita" required></label><br>
        <label>Corso:
            <select name="id_corso" required>
                <?php foreach ($corsi as $corso): ?>
                    <option value="<?php echo $corso['id_corso']; ?>"><?php echo $corso['nome_corso'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <button type="submit">Invio</button>
    </form>
    <a href="index.php">Torna al menù</a>
</body>
</html>
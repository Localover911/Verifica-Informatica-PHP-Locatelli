<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_iscrizione'], $_POST['new_id_corso'])) {
    $id_iscrizione = $_POST['id_iscrizione'];
    $new_id_corso = $_POST['new_id_corso'];

    $stmt = $pdo->prepare("UPDATE Iscrizioni_Corsi SET id_corso = ? WHERE id_iscrizione = ?");
    $stmt->execute([$new_id_corso, $id_iscrizione]);
    echo "Corso aggiornato con successo!";
}

$iscritti = $pdo->query("
    SELECT 
        Iscrizioni_Corsi.id_iscrizione,
        Membri.nome AS nome_membro,
        Membri.cognome AS cognome_membro,
        Corsi.nome_corso AS nome_corso_attuale,
        Corsi.id_corso AS id_corso_attuale
    FROM Iscrizioni_Corsi
    WHERE  Iscrizioni_Corsi.id_membro = Membri.id_membro and Iscrizioni_Corsi.id_corso = Corsi.id_corso
    
")->fetchAll(PDO::FETCH_ASSOC);

$corsi = $pdo->query("SELECT id_corso, nome_corso FROM Corsi")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Iscritti</title>
</head>
<body>
    <h1>Elenco Iscritti</h1>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Corso Attuale</th>
            <th>Cambia Corso</th>
        </tr>
        <?php foreach ($iscritti as $iscritto): ?>
            <tr>
                <td><?php echo htmlspecialchars($iscritto['nome_membro']); ?></td>
                <td><?php echo htmlspecialchars($iscritto['cognome_membro']); ?></td>
                <td><?php echo htmlspecialchars($iscritto['nome_corso_attuale']); ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id_iscrizione" value="<?php echo $iscritto['id_iscrizione']; ?>">
                        <select name="new_id_corso" required>
                            <?php foreach ($corsi as $corso): ?>
                                <option value="<?php echo $corso['id_corso']; ?>" <?php echo $corso['id_corso'] == $iscritto['id_corso_attuale'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($corso['nome_corso']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Cambia</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Torna al menù</a>
</body>
</html>
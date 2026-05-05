<?php
session_start();
//inserimento credenziali d'accesso
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Controllo della password "Verifica"
    if ($password === 'verifica') {
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Username o password errati!";
    }
}

// Se l'utente è già loggato reindirizza a index.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login gestione palestra</title>
</head>
<body>
    <div class="login-container">
        <h1>Palestra Locatelli</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Accedi">
        </form>
    </div>
</body>
</html>
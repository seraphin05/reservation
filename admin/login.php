<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $mdp = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE nom = ?");
    $stmt->execute([$nom]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($mdp, $admin['mot_de_passe'])) {
        $_SESSION['admin'] = $admin['nom'];
        header('Location: index.php');
        exit;
    } else {
        $erreur = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-5">Connexion Admin</h2>
    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
</body>
</html>

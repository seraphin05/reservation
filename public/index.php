<?php
require_once '../config/database.php';

$stmt = $pdo->query("SELECT * FROM tables WHERE disponible = 1");
$tables = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Accueil</title></head>
<body>
    <h1>Tables disponibles</h1>
    <?php foreach ($tables as $table): ?>
        <div>
            <h2>Table <?= htmlspecialchars($table['numero']) ?> - <?= htmlspecialchars($table['nom']) ?></h2>
            <p><?= nl2br(htmlspecialchars($table['description'])) ?></p>
            <a href="../reservation/reserver.php?table_id=<?= $table['id'] ?>">Réserver</a>
        </div>
        
    <?php endforeach; ?>

    <?php
   // $pass = password_hash("admin123", PASSWORD_DEFAULT);
    // tu peux l'utiliser une seule fois pour insérer
   // echo $pass;

    ?>


    
</body>
</html>

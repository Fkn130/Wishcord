<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Discord de Wish</title>
</head>
<body>
    <h1>Accueil</h1>

    <?php require_once 'nav.php'; ?>
    <div style="text-align: center; margin-top: 20px;">
      <p>Veuillez vous connecter pour accéder à votre espace client.</p>
    </div>
    <div style="text-align: center; margin-top: 20px;">
      <a href="connexion.php">
        <button type="button">Connexion</button>
      </a>
    </div>
</body>
</html>
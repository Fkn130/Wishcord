<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Discord de Wish</title>
</head>
<body >
    <h1>Connexion</h1>
    <form method="POST" action="../Log/login.php">
        <p>Identifiant:</p>
        <input type="text" name="identifiant" placeholder="Votre Identifiant" /></br>
        <p>Mot de passe:</p>
        <input type="password" name="mot_de_passe_hash" placeholder="Mot de Passe" /></br>
        <input type="submit" value="Connectez-Vous"/>
    </form>
    <?php if (isset($_GET['erreur'])): ?>
        <p style="color: red;">Identifiant ou mot de passe incorrect.</p>
    <?php endif; ?>
</body>
</html>

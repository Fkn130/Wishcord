<?php
session_start();

// 1. Vérifier si l'utilisateur est bien connecté
if (!isset($_SESSION['id_utili'])) {
    header('Location: ../Authentification/connexion.php');
    exit();
}

// 2. Vérifier si le lien/invitation est fourni dans l'URL (ex: salon.php?token=xyz)
$token = $_GET['token'] ?? null;
if (!$token) {
    die("Accès refusé : Vous devez posséder un lien d'invitation valide pour rejoindre ce salon.");
}

// 3. Récupérer le pseudo de l'utilisateur connecté
$pseudo_connecte = $_SESSION['pseudo'] ?? '';

// 4. Charger l'historique des messages depuis le fichier JSON
$fichier = 'log_Utili.json';
$messages = [];

if (file_exists($fichier)) {
    $messages = json_decode(file_get_contents($fichier), true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Discord de Wish</title>
</head>
<body>

    <h1>Salon de Discussion</h1>

    <!-- Zone d'affichage des messages -->
    <div id="salon-messages">
        <?php foreach ($messages as $msg): ?>
            <p>
                <strong><?php echo htmlspecialchars($msg['pseudo']); ?> :</strong> 
                <?php echo htmlspecialchars($msg['texte']); ?>
            </p>
        <?php endforeach; ?>
    </div>

    <br><br>

    <!-- Formulaire d'envoi -->
    <form action="send_message.php" method="POST">
        <label><?php echo htmlspecialchars($pseudo_connecte); ?> :</label>
        <input type="text" name="message" placeholder="Tapez votre message ici..." required />
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
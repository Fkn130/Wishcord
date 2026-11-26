<?php
session_start();

/* 1. Vérifier si l'utilisateur est connecter ou non 
if (!isset($_SESSION['id_utili'])) {
    header('Location: ../Authentification/connexion.php');
    exit();
}*/

$pseudo_connecte = $_SESSION['pseudo'] ?? '';

// 2. Charger la liste des utilisateurs pour pouvoir choisir le destinataire a qui envoyé le message
$fichier_users = '../Authentification/Utilisateurs.json';
$utilisateurs = file_exists($fichier_users) ? json_decode(file_get_contents($fichier_users), true) : [];

// 3. Charger les messages privés
$fichier_mp = 'log_mp.json';
$messages_prives = file_exists($fichier_mp) ? json_decode(file_get_contents($fichier_mp), true) : [];
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Discord de Wish</title>
</head>
<body>

    <h1>Messages Privés</h1>
    <p>Connecté en tant que : <strong><?php echo htmlspecialchars($pseudo_connecte); ?></strong></p>

    <!-- Zone d'affichage des messages privés reçus et envoyés -->
    <div id="mp-box">
        <h3>Vos discussions :</h3>
        <?php foreach ($messages_prives as $mp): ?>
            <?php 
            // N'afficher que les messages qui concernent l'utilisateur connecté
            if ($mp['expediteur'] === $pseudo_connecte || $mp['destinataire'] === $pseudo_connecte): 
            ?>
                <p>
                    <strong>[De <?php echo htmlspecialchars($mp['expediteur']); ?> à <?php echo htmlspecialchars($mp['destinataire']); ?>] :</strong> 
                    <?php echo htmlspecialchars($mp['texte']); ?>
                </p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <br>
    <hr>
    <br>

    <!-- Formulaire d'envoi de message privé -->
    <form action="envoie_message.php" method="POST">
        <label for="destinataire">Envoyer à :</label>
        <select name="destinataire" id="destinataire" required>
            <option value="">-- Choisir un utilisateur --</option>
            <?php foreach ($utilisateurs as $user): ?>
                <?php if ($user['identifiant'] !== $pseudo_connecte): ?>
                    <option value="<?php echo htmlspecialchars($user['identifiant']); ?>">
                        <?php echo htmlspecialchars($user['identifiant']); ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br>
        <br>

        <input type="text" name="message" placeholder="Votre message privé..." required />
        <br>
        <button type="submit">Envoyer un message</button>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- Formulaire d'envoi de réponse des messages privés -->
        <form action="repon_message.php" method="POST">
        <label for="destinataire">Envoyer à :</label>
        <select name="destinataire" id="destinataire" required>
            <option value="">-- Choisir un utilisateur --</option>
            <?php foreach ($utilisateurs as $user): ?>
                <?php if ($user['identifiant'] !== $pseudo_connecte): ?>
                    <option value="<?php echo htmlspecialchars($user['identifiant']); ?>">
                        <?php echo htmlspecialchars($user['identifiant']); ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br>
        <br>

        <input type="text" name="message" placeholder="Votre réponse ..." required />
        <br>
        <button type="submit">Envoyer un message</button>
    </form>
</body>
</html>
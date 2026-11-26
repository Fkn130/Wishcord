<?php
session_start();

// 1. Vérifier si l'utilisateur est connecté et si un message a été soumis
if (isset($_SESSION['pseudo']) && !empty($_POST['message'])) {
    
    $pseudo = $_SESSION['pseudo'];
    $message = trim($_POST['message']);

    // 2. Connexion à la base de données (Exemple avec PDO)
    $bdd = new PDO('mysql:host=localhost;dbname=tp_discord;charset=utf8', 'root', '');

    // 3. Insertion du message
    $req = $bdd->prepare('INSERT INTO messages (pseudo, texte, date_envoi) VALUES (?, ?, NOW())');
    $req->execute([$pseudo, $message]);
}

// 4. Redirection vers la discussion privé pour repondre
header('Location: message_prive.php');
exit();
?>
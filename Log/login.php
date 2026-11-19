<?php
session_start();

// 1. Récupération des données saisies dans le formulaire
$identifiant = $_POST['identifiant'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

// 2. Lecture du fichier JSON contenant les utilisateurs
$fichier = '../Authentification/Utilisateurs.json';
$utilisateurs = file_exists($fichier) ? json_decode(file_get_contents($fichier), true) : [];

$connexion_reussie = false;

// 3. Vérification de l'identifiant et du mot de passe
foreach ($utilisateurs as $user) {
    if ($user['identifiant'] === $identifiant && password_verify($mot_de_passe, $user['mot_de_passe_hash'])) {
        $connexion_reussie = true;
        // On enregistre le pseudo dans la session pour l'afficher sur salon.php
        $_SESSION['pseudo'] = $user['identifiant'];
        break;
    }
}

// 4. Redirection selon le résultat de la vérification
if ($connexion_reussie) {
    header('Location: ../Salon/salon.php');
    exit();
} else {
    // Échec : retour sur la page de connexion avec message d'erreur
    header('Location: ../Authentification/connexion.php?erreur=1');
    exit();
}
?>
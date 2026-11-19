<?php
$salt = "Idon'tcare";
$empFound = false;
$mdp_valid = false;
$mesUtilisateurs = json_decode(file_get_contents("utilisateurs.json"), true);
$nbUtili = count($mesUtilisateurs);
$i = 0;

$identifiant_saisi = $_POST['identifiant'] ?? '';
$mdp_saisi = $_POST['mdp'] ?? '';

// Initialisation du log
$log = array();
$log["date"] = date("d-m-Y H:i:s"); // Correction de la fonction de date
$log["identifiant_saisi"] = $identifiant_saisi;

if(!file_exists("log_Utili.json")){
    file_put_contents("log_Utili.json", json_encode([]));
}

while($i < $nbUtili && !$empFound){
    if($mesUtilisateurs[$i]["identifiant"] == $identifiant_saisi){
        $empFound = true;
        // Vérification du hachage du mot de passe
        $mdp_valid = hash_equals($mesUtilisateurs[$i]["mdp"], hash('sha256', $mdp_saisi . $salt));
        if($mdp_valid){
            $log["success"] = true;
            $log["nom"] = $mesUtilisateurs[$i]["nom"];
            $log["expiration"] = date("Y-m-d H:i:s", strtotime('+10 minutes'));
            // Générer et attribuer le token JWT ici si demandé par la suite
        } else {
            $log["success"] = false;
            $log["erreur"] = "Mot de passe incorrect";
        }
    }
    $i++;
}

// Si l'utilisateur n'existe pas du tout dans la base
if(!$empFound){
    $log["success"] = false;
    $log["erreur"] = "Identifiant inconnu";
}

// Enregistrement du log dans le fichier JSON (ajout au tableau existant)
$logs_existants = json_decode(file_get_contents("log_Utili.json"), true);
$logs_existants[] = $log;
file_put_contents("log_Utili.json", json_encode($logs_existants, JSON_PRETTY_PRINT));

if ($empFound && $mdp_valid) {
    echo "Connexion réussie ! Bienvenue " . htmlspecialchars($log["nom"]);
} else {
    echo "Échec de la connexion : identifiant ou mot de passe invalide.";
}
?>

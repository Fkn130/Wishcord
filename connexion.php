<?php
require "bdd.php";  
$bouton = $_POST['connect'];
$email = $_POST['email'];
$password = $_POST['password'];


if ($bouton == 1) {

    $sql = "SELECT count(*) as nb FROM user WHERE email = ? AND mot_de_passe=SHA(?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $resultats = mysqli_stmt_get_result($stmt);

    while ($ligne = mysqli_fetch_assoc($resultats)) {

        if ($ligne['nb'] == 1) {
            session_start();

            if (strpos($email, '--') !== false) {
                echo "programme arrêté";
                exit();
            }

            // token JWP
            $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
            $payload = json_encode(['user_id' => $id_user, 'email' => $email]);

            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

            $secret = 'MaCléUlTrASecRèteUwU123';
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

            $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
            $_SESSION['jwt'] = $jwt;
            setcookie('auth_token', $jwt, time() + 3600, '/');

            echo 'connecté';
            header('Location: ../site/login/index.php'); //a changer plus tard

        } else {
            echo 'pas connecté';
        }
    }
} else {
    $sql = "SELECT count(*) as nb FROM user WHERE email = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultats = mysqli_stmt_get_result($stmt);
    
    if ('email' == $email) {
        echo "email deja utilisé";

    } else {

        $sql = "INSERT INTO user (email, mot_de_passe) VALUES (?, SHA(?))";
        $stmt = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        // tOKO JWT
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode(['user_id' => $id_user, 'email' => $email]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $secret = 'MaCléUlTrASecRèteUwU123';
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        $_SESSION['jwt'] = $jwt;
        setcookie('auth_token', $jwt, time() + 3600, '/');
        // --------------------------

        header('Location: ../site/login/index.php');//a changer plus tard

    }
}
?>
<?php
    $host = "localhost";
    $user = "root";
    $pwd = "";

    $connexion = mysqli_connect ($host, $user, $pwd );

  if (!$connexion) {
    die("Erreur ");
  }
?>
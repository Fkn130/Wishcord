<?php
  


    $host = "localhost";
    $user = "root";
    $pwd = "";
    $schema = "wishcord";



    $connexion = mysqli_connect ($host, $user, $pwd, $schema);

  if (!$connexion) {
    die("Erreur ");
}
    ?>
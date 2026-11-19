<nav>
    <ul>
        <a href="index.php">Accueil</a>
        <a href="connexion.php">Connexion</a>
        <?php if (isset($_SESSION['id_utili'])): ?>
            <a href="../Salon/salon.php">Salon</a>
            <a href="../Message privée/message_prive.php">Messages privés</a>
            <a href="deconnexion.php">Déconnexion</a>
        <?php endif; ?>
    </ul>
</nav>
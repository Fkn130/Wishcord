<nav>
    <ul>
        <a href="index.php">Accueil</a>
        <a href="connexion.php">Connexion</a>
        <?php if (isset($_SESSION['id_utili'])): ?>
            <a href="../Wishcord-main/salon.php">Salon</a>
            <a href="../Wishcord-main/message_prive.php">Messages privés</a>
            <a href="deconnexion.php">Déconnexion</a>
        <?php endif; ?>
    </ul>
</nav>
<?php
require_once __DIR__ . '../../../../vendor/autoload.php';
// Démarrage ou reprise de la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/blog/public/index.php">Mon Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/blog/public/index.php">Accueil</a>
            </li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['user_role'] == 'ADMIN'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/src/View/admin/posts/index.php">Dashboard</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/public/index.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/src/view/user/logout.php">Déconnexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/src/view/user/logout.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/public/index.php">Inscription</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Le reste de votre contenu HTML -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

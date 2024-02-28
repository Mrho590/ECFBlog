<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil du Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require '../layout/header.php'; ?>

    <div class="container mt-5">
        <h1>Posts récents</h1>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Publié le <?= htmlspecialchars($post['publish_date']) ?> par <?= htmlspecialchars($post['author']) ?></h6>
                            <p class="card-text"><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
                            <a href="/post/view/<?= $post['id'] ?>" class="btn btn-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Précédent</a>
                </li>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

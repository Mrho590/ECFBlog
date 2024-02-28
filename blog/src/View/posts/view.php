<!-- src/View/posts/view.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require '../layout/header.php'; ?>

<div class="container mt-4">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <hr>
        <h3>Commentaires</h3>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text"><?= htmlspecialchars($comment['comment']) ?></p>
                        <footer class="blockquote-footer"><?= htmlspecialchars($comment['comment_date']) ?></footer>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun commentaire pour cet article.</p>
        <?php endif; ?>
    </div>
</body>
</html>

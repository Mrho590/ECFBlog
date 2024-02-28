<!-- src/View/admin/posts/index.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require '../layout/header.php'; ?>
    <div class="container">
        <h1>Gestion des posts</h1>
        <a href="/admin/post/create" class="btn btn-primary">Ajouter un post</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <th scope="row"><?= $post['id'] ?></th>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td>
                            <a href="/admin/post/edit/<?= $post['id'] ?>" class="btn btn-secondary">Modifier</a>
                            <a href="/admin/post/delete/<?= $post['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

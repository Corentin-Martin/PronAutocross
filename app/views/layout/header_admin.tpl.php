<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $baseURI ?>assets/css/style.css">
    <title>Document</title>
</head>
<body>
<header class="admin_header">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $router->generate('admin'); ?>">Admin Pron'Autocross</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="<?= $router->generate('admin'); ?>">QG</a>
                <a class="nav-link" href="<?= $router->generate('question-home'); ?>">Questions</a>
                <a class="nav-link" href="<?= $router->generate('entrylist-home'); ?>">Liste des engagés</a>
                <a class="nav-link" href="<?= $router->generate('verification-home'); ?>">Vérifications</a>
                <a class="nav-link" href="<?= $router->generate('driver-home'); ?>">Pilotes</a>
                <a class="nav-link" href="<?= $router->generate('category-list'); ?>">Catégories</a>
                <a class="nav-link" href="<?= $router->generate('race-home'); ?>">Courses</a>
            </div>
            </div>
        </div>
    </nav>

</header>

<main class="main__admin">



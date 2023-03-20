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
            <a class="navbar-brand" href="<?= $this->router->generate('home'); ?>">Pron'Autocross</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <?php if (!$_SESSION) : ?>
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Connexion/Inscription
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= $this->router->generate('user-login'); ?>">Se connecter</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('user-inscription'); ?>">S'inscrire</a></li>
            </ul>
            <?php endif; ?>
                <a class="nav-link" href="#">Règles du jeu</a>
                <a class="nav-link" href="<?= $this->router->generate('general', ['year' => date('Y')]); ?>">Classement général</a>
                <a class="nav-link" href="<?= $this->router->generate('results', ['year' => date('Y'), 'id' => 1]); ?>">Classement par course</a>

            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="<?= $this->router->generate('user-dashboard'); ?>">Votre tableau de bord</a>
                <a class="nav-link" href="<?= $this->router->generate('user-logout'); ?>">Deconnexion</a>
            <?php endif; ?>
            </div>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['user'])) : ?>
        <div>
            <h4>Bienvenue <?= $_SESSION['user']->getPseudo(); ?></h4>
        </div>
    <?php endif; ?>

</header>

<main class="main">



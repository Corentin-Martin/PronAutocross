<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://bootswatch.com/5/lumen/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=faster-one:400" rel="stylesheet" />
    <link rel="stylesheet" href="<?= $baseURI ?>assets/css/style.css">
    <title>Pron'Autocross</title>
</head>
<body class="container-fluid bg-secondary">

<header class="row m-auto">

        <div class="col-12"><h1 class="header__title">Pron'Autocross</h1></div>


        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= $this->router->generate('home'); ?>">Pron'Autocross</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <?php if (!$_SESSION) : ?>
                        <a class="nav-link active dropdown-toggle justify-content-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Connexion/Inscription
                        </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $this->router->generate('user-login'); ?>">Se connecter</a></li>
                                <li><a class="dropdown-item" href="<?= $this->router->generate('user-inscription'); ?>">S'inscrire</a></li>
                            </ul>
                        <?php endif; ?>

                            <a class="nav-link active" href="#">
                                Règles du jeu
                            </a>
                            <a class="nav-link active" href="<?= $this->router->generate('general', ['year' => date('Y')]); ?>">
                                Classement général
                            </a>
                            <a class="nav-link active" href="<?= $this->router->generate('results', ['year' => date('Y'), 'id' => 1]); ?>">
                                Classement par course
                            </a>

                            <?php if (isset($_SESSION['user'])) : ?>
                            <a class="nav-link active" href="<?= $this->router->generate('user-dashboard'); ?>">
                                Votre tableau de bord
                            </a>
                            <?php if ($_SESSION['user']->getRole() === 'admin' || $_SESSION['user']->getRole() === 'editor') : ?>
                            <a class="nav-link active" href="<?= $this->router->generate('admin'); ?>">
                                Back-Office Admin
                            </a>
                            <?php endif; ?>
                            <a class="nav-link active" href="<?= $this->router->generate('user-logout'); ?>">
                                Deconnexion
                            </a>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>



</header>

<main>



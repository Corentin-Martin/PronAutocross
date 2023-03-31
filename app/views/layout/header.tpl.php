<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= $baseURI ?>assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $baseURI ?>assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $baseURI ?>assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $baseURI ?>assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $baseURI ?>assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $baseURI ?>assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $baseURI ?>assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $baseURI ?>assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $baseURI ?>assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= $baseURI ?>assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $baseURI ?>assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= $baseURI ?>assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $baseURI ?>assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= $baseURI ?>assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= $baseURI ?>assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#158CBA">

    <meta name="description" content="Pron'Autocross, le site pour parier sur les résultats des courses des championnats et coupes de France d'Autocross et de Sprint Car !">
    
    <link href="https://bootswatch.com/5/lumen/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=faster-one:400" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= $baseURI ?>assets/css/style.css">
    <title>Pron'Autocross</title>
</head>

<body class="container-fluid bg-secondary text-center">

    <header class="row m-auto">

            <a href="<?= $this->router->generate('home'); ?>" class="header__title fs-1 col-12 text-decoration-none">Pron'Autocross</a>

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <?php if ($_SESSION) : ?>
                        <a class="navbar-brand" href="<?= $this->router->generate('user-dashboard'); ?>">#<?= $_SESSION['user']->getPseudo() ?></a>
                    <?php else : ?>
                        <a class="navbar-brand" href="<?= $this->router->generate('home'); ?>">Pron'Autocross</a>
                    <?php endif; ?>

                    <?php if ($_SESSION && $gameInProgress) : ?>
                    <a class="btn btn-danger" href="<?= $this->router->generate('user-add', ['id' => $raceInProgress->getId()]) ?>">JOUER POUR <?= $raceInProgress->getName() ?></a>
                    <?php endif; ?>
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

                                <a class="nav-link active" href="<?= $this->router->generate('rules'); ?>">
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

    <main class='main m-auto'>



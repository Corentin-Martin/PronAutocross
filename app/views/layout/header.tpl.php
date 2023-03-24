<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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

    <main class='main m-auto vh-100 overflow-auto'>



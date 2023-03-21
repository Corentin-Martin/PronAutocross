<div class="row"> <h3>Votre tableau de bord</h3></div>
<div class="row"> <h5>Bienvenue <?= $_SESSION['user']->getPseudo(); ?></h5></div>
<div class="row">

    <div class="col-12 col-sm-6">
        <div class="col-12">Vos infos personnelles</div>
        <div class="row">
            <div class="col-6">Pseudo</div>
            <div class="col-6"><?= $_SESSION['user']->getPseudo(); ?></div>
        </div>
        <div class="row">
            <div class="col-6">Prénom</div>
            <div class="col-6"><?= $_SESSION['user']->getFirstName(); ?></div>
        </div>
        <div class="row">
            <div class="col-6">Nom de famille</div>
            <div class="col-6"><?= $_SESSION['user']->getLastName(); ?></div>
        </div>
        <div class="row">
            <div class="col-6">Adresse mail</div>
            <div class="col-6"><?= $_SESSION['user']->getMail(); ?></div>
        </div>
        <div class="row"><a href="<?= $this->router->generate('user-update', ['id' => $_SESSION['user']->getId()]) ?>">Modifier ces infos ou changer de mot de passe</a></div>
    </div>

    <div class="col-12 col-sm-6">
        
        <div class="col-12">Votre classement général</div>

        <div class="col-12"><?= $general->getPlace() ?> <?= ($general->getPlace() == 1) ? "er" : "ème" ?> - <?= $general->getTotal() ?> points</div>

    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="col-12">Vos derniers résultats</div>
        <div class="col-12">
            <?php foreach ($scores as $score) : ?>        
            <div class="row">
                <div class="col-4"><?= $racesById[$score->getRaceId()]->getName() ?></div>
                <div class="col-4"><?= $score->getPlace() ?> <?= ($score->getPlace() == 1) ? "er" : "ème" ?></div>
                <div class="col-4"><?= $score->getTotal() ?> points</div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-12 col-sm-6">Vos dernières participations</div>
</div>

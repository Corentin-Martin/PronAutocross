<h3 class="col-8 col-sm-5 bg-primary mt-3 mx-auto p-2 text-light rounded-4 shadow">Votre tableau de bord</h3>

<?php $token = $_SESSION['token'] = random_bytes(5); ?>

<div class="row m-auto justify-content-center mt-3" style="max-width: 85%;">

    <div class="card text-white bg-primary mb-2">
        <div class="card-header">
            <a class="btn" href="<?= $this->router->generate('user-modification', ['id' => $_SESSION['user']->getId()]) ?>">Vos infos personnelles</a>
        </div>
        <div class="card-body">
                <p class="card-text">Pseudo : <strong><?= $_SESSION['user']->getPseudo(); ?></strong></p>
                <p class="card-text">Prénom : <strong><?= $_SESSION['user']->getFirstName(); ?></strong></p>
                <p class="card-text">Nom de famille : <strong><?= $_SESSION['user']->getLastName(); ?></strong> </p>
                <p class="card-text">Adresse mail : <strong><?= $_SESSION['user']->getMail(); ?></strong> </p>
                <a href="<?= $this->router->generate('user-modification', ['id' => $_SESSION['user']->getId()]) ?>" class="btn btn-info">Modifier mes infos</a>
        </div>
    </div>

    <div class="card bg-success mb-2">
        <div class="card-header">
            <a class="btn" href="<?= $this->router->generate('general', ['year' => date('Y')]) ?>">Votre classement général</a>
        </div>
        <div class="card-body">
            <a class="btn btn-outline-light fs-4" href="<?= $this->router->generate('general', ['year' => date('Y')]) ?>">
                <?php if($general->getPlace() == 0) : ?>
                    Non classé
                <?php else : ?>
                    <strong><?= $general->getPlace() ?> <?= ($general->getPlace() == 1) ? "er" : "ème" ?></strong> - <?= $general->getTotal() ?> points
                <?php endif; ?>
                </a>
        </div>
    </div>
    
</div>

<div class="row m-auto justify-content-center mt-3" style="max-width: 85%;">

    <div class="accordion col-12 col-sm-6 mb-2 p-0" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed bg-info fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Vos résultats
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php foreach ($scores as $score) : ?>        
                        <div class="row">
                            <a class="btn btn-outline-primary col-6" href="<?= $this->router->generate('results', ['year' => $score->getYearId(), 'id' => $score->getRaceId()]) ?>">
                                <?= $racesById[$score->getRaceId()]->getName() ?>
                            </a>
                            <a class="btn col-6" href="<?= $this->router->generate('results', ['year' => $score->getYearId(), 'id' => $score->getRaceId()]) ?>">
                                <?= $score->getPlace() ?> <?= ($score->getPlace() == 1) ? "er" : "ème" ?> - <?= $score->getTotal() ?> points
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($scores)) : ?>
                        Aucun résultat à afficher pour le moment
                    <?php endif; ?>
                    <a href="<?= $this->router->generate('user-charts'); ?>" class="btn btn-info mt-2">Voir l'évolution de vos résultats</a>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion col-12 col-sm-6 mb-2 p-0" id="accordionParticipations">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed bg-info fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Vos participations
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionParticipations">
                <div class="accordion-body">
                    <?php foreach ($participations as $participation) : ?>
                        <a class="btn btn-outline-primary col-12" href="<?= $this->router->generate('user-recap', ['id' => $participation->getRaceId()]) ?>">
                            <?= $racesById[$participation->getRaceId()]->getName() ?>
                        </a>
                    <?php endforeach; ?>
                    <?php if (empty($participations)) : ?>
                        Aucun participation à afficher pour le moment
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion col-12 col-sm-6 mb-2 p-0" id="accordionFriends">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed bg-info fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Vos amis
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFriends">
                <div class="accordion-body">
                    <a class="btn btn-outline-primary col-12 mb-3" href="<?= $this->router->generate('user-addFriends') ?>">
                        Ajouter un ami
                    </a>
                    <?php foreach ($friends as $friend) : ?>
                        <div class="row">
                            <a class="btn btn-outline-warning col-12" href="<?= $this->router->generate('user-frienddashboard', ['friendId' => $friend['id']]) ?>">
                            <?= $friend['pseudo']; ?>
                            </a>
                            <div class="col-12 mt-1 mb-1 d-flex justify-content-between">
                                <div class="btn col-11">
                                    <?php if($friend['place'] == 0) : ?>
                                        Non classé
                                    <?php else : ?>
                                        <strong><?= $friend['place']; ?> <?= ($friend['place'] == 1) ? "er" : "ème" ?></strong> - <?= $friend['total']; ?> points
                                    <?php endif; ?>   
                                </div>
                                <div class="dropdown col-1">
                                    <button class="btn btn-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">X</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="">Oups...</a></li>
                                        <li><a class="dropdown-item" href="<?= $this->router->generate('user-deleteFriend', ['friendId' => $friend['id'], 'token' => bin2hex($token)]) ?>">Ne plus suivre</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($friends)) : ?>
                        Vous n'avez pour le moment sélectionné aucun ami.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


</div>
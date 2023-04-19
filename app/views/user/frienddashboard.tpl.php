<h3 class="col-8 col-sm-5 bg-primary mt-3 mx-auto p-2 text-light rounded-4 shadow">#<span class="fw-bold"><?= $player->getPseudo() ?></span></h3>


<div class="row m-auto justify-content-center mt-3" style="max-width: 85%;">

    <div class="card bg-secondary mb-2">
        <div class="card-header">
            <a class="btn" href="<?= $this->router->generate('general', ['year' => date('Y')]) ?>">Son classement général</a>
        </div>
        <div class="card-body">
            <a class="btn btn-outline-warning fs-4" href="<?= $this->router->generate('general', ['year' => date('Y')]) ?>">
                <?php if($general->getPlace() == 0) : ?>
                    Non classé
                <?php else : ?>
                    <strong><?= $general->getPlace() ?> <?= ($general->getPlace() == 1) ? "er" : "ème" ?></strong> - <?= $general->getTotal() ?> points
                <?php endif; ?>
            </a>
        </div>
    </div>

    <div class="card bg-light mb-2">
        <div class="card-header">
            <div class="btn">Ses résultats</div>
        </div>
        <div class="card-body">
            <?php foreach ($scores as $score) : ?>        
                <div class="row">
                    <a class="btn btn-outline-secondary col-6 shadow" href="<?= $this->router->generate('results', ['year' => $score->getYearId(), 'id' => $score->getRaceId()]) ?>">
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
        </div>
    </div>

    <a type="button" class="btn btn-dark btn-lg mt-3 mb-2 col-10 col-sm-5"  href="<?= $this->router->generate('user-dashboard') ?>">Retour sur votre tableau de bord personnel</a>

</div>
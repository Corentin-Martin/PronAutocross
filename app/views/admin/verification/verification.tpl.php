<div class="row mt-3 justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Validation de <?= $racesById[$verification->getRaceId()]->getName() ?> - <?= $verification->getYearId() ?></h2>

    <?php foreach ($categories as $category) : ?>
        <div>
            <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3"><?= $category->getName() ?></h4>
            <h5 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->{'get'.$categoriesOnDB[$category->getId()]}()?></h5>
            <h6 class="btn <?= ($verification->{'get'.$categoriesOnDB[$category->getId()]}() == 0) ? 'btn-outline-danger' : 'btn-success' ?> col-5"><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getLastName() ?></h6>
            <?php for ($i = 2; $i <6; $i++) : ?>
                <h6 class="btn <?= ($verification->{'get'.$categoriesOnDB[$category->getId()].$i}() == 0) ? 'btn-outline-danger' : 'btn-success' ?> col-5"><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()].$i}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()].$i}()]->getLastName() ?></h6>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>
    <div>
        <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3">Bonus 1</h4>
        <h5 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->getBonus1() ?></h5>
        <h6 class="btn btn-success col-5"><?= $verification->getBonus1() ?></h6>
    </div>
    <div>
        <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3">Bonus 2</h4>
        <h5 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->getBonus2() ?></h5>
        <h6 class="btn btn-success col-5"><?= $verification->getBonus2() ?></h6>
    </div>

    <a type="button" class="btn btn-info btn-lg mt-3 col-8"  href="<?= $this->router->generate('verification-edit', ['raceId' => $verification->getRaceId(),'id' => $verification->getId()]) ?>">Je veux éditer cette vérification</a>

    <form action="" method="post">
        <input type="hidden" name="yearId" value="<?= $verification->getYearId()?>">
        <input type="hidden" name="raceId" value="<?= $verification->getRaceId()?>">
        <?php $token = $_SESSION['token'] = random_bytes(5); ?>
        <input type="hidden" name="token" value="<?= $token ?>">
        <button class="btn btn-success btn-lg mt-3 col-8"type="submit">C'EST OK, je veux lancer le calcul du score !</button>
    </form>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('verification-home') ?>">Retour</a>

</div>

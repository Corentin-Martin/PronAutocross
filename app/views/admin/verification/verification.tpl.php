
<div class="admin__container">

    <h2 class="admin__container__title">Validation de <?= $racesById[$verification->getRaceId()]->getName() ?> - <?= $verification->getYearId() ?></h2>

    <?php foreach ($categories as $category) : ?>

        <div>
            <h4 class="questionnaire__title"><?= $category->getName() ?></h4>
            <h5 class="questionnaire__subtitle"><?= $questions->{'get'.$categoriesOnDB[$category->getId()]}()?></h5>
            <h6 class="validation__driver"><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getLastName() ?></h6>
        </div>

    <?php endforeach; ?>

    <div>
        <h4 class="questionnaire__title">Bonus 1</h4>
        <h5 class="questionnaire__subtitle"><?= $questions->getBonus1() ?></h5>
        <h6 class="validation__driver"><?= $verification->getBonus1() ?></h6>
    </div>

    <div>
        <h4 class="questionnaire__title">Bonus 2</h4>
        <h5 class="questionnaire__subtitle"><?= $questions->getBonus2() ?></h5>
        <h6 class="validation__driver"><?= $verification->getBonus2() ?></h6>
    </div>

    <div>
        <a type="button" class="btn btn-info btn-lg"  href="<?= $this->router->generate('verification-edit', ['raceId' => $verification->getRaceId()]) ?>">Je veux éditer cette vérification</a>
    </div>

    <div>
        <form action="" method="post">
            <input type="hidden" name="yearId" value="<?= $verification->getYearId()?>">
            <input type="hidden" name="raceId" value="<?= $verification->getRaceId()?>">
            <button class="btn btn-success btn-lg"type="submit">C'EST OK, je veux lancer le calcul du score !</button>
        </form>
    </div>
    
    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('verification-home') ?>">Retour</a>
    </div>

</div>

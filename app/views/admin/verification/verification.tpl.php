<h2>Pour la course de <?= $racesById[$verification->getRaceId()]->getName() ?> - <?= $verification->getYearId() ?></h2>

Vous avez validé les résultats suivants :

<?php foreach ($categories as $category) : ?>

    <div>
        <h4><?= $category->getName() ?></h4>
        <h5><?= $questions->{'get'.$categoriesOnDB[$category->getId()]}()?></h5>
        <h6><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getLastName() ?></h6>
    </div>

<?php endforeach; ?>

    <div>
        <h4>Bonus 1</h4>
        <h5><?= $questions->getBonus1() ?></h5>
        <h6><?= $verification->getBonus1() ?></h6>
    </div>

    <div>
        <h4>Bonus 2</h4>
        <h5><?= $questions->getBonus2() ?></h5>
        <h6><?= $verification->getBonus2() ?></h6>
    </div>

<div>
    <a href="<?= $router->generate('verification-edit', ['id' => $verification->getId()]) ?>">Je veux éditer cette vérification</a>
</div>
<div>
    <form action="" method="post">
        <input type="hidden" name="yearId" value="<?= $verification->getYearId()?>">
        <input type="hidden" name="raceId" value="<?= $verification->getRaceId()?>">
        <button type="submit">C'EST OK, je veux lancer le calcul du score !</button>
    </form>
</div>
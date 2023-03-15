

<?php if (!isset($verification)) : ?>
    <h2>Créer un formulaire de vérification</h2>
<?php foreach ($years as $year) : ?>

    <a href="<?= $router->generate('verification-add', ['year' => $year->getId(), 'raceId' => $currentRace]) ?>"><?= $year->getId() ?></a>

<?php endforeach; ?>

<?php foreach ($racesById as $race) : ?>

<a href="<?= $router->generate('verification-add', ['year' => $currentYear, 'raceId' => $race->getId()]) ?>"><?= $race->getName() ?></a>

<?php endforeach; ?>
<?php endif; ?>

<h3><?= $currentYear ?> - <?= $racesById[$currentRace]->getName() ?></h3>

<form action="" method="post">
    <input type="hidden" name="raceId" value="<?= $currentRace ?>">
    <input type="hidden" name="yearId" value="<?= $currentYear ?>">

<?php foreach ($categories as $category) : ?>
    <div>
        <h4><?= $category->getName() ?></h4>

        <label for="<?= $categoriesOnDB[$category->getId()] ?>">
            <?= $questions->{'get'.$categoriesOnDB[$category->getId()]}() ?>

            <select name="<?= $categoriesOnDB[$category->getId()] ?>" id="<?= $categoriesOnDB[$category->getId()] ?>">

                <?php if (isset($verification)) : ?>
                    <option value="<?=$verification->{'get'.$categoriesOnDB[$category->getId()]}()?>" selected><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getNumber() . " - " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()]}()]->getLastName() ?></option>
                <?php endif; ?>
                <?php foreach ($entryList[$category->getId()] as $entry) : ?>
                    <option value="<?= $entry->getDriverId() ?>"><?= $driversById[$entry->getDriverId()]->getNumber() . " - " . $driversById[$entry->getDriverId()]->getFirstName() . " " . $driversById[$entry->getDriverId()]->getLastName() ?></option>
                <?php endforeach; ?>

            </select>
        </label>
    </div>
<?php endforeach; ?>
    <div>
        <h4>Bonus 1</h4>

        <label for="bonus1">
            <?= $questions->getBonus1() ?>

            <select name="bonus1" id="bonus1">
                <?php if (isset($verification)) : ?>
                    <option value="<?=$verification->getBonus1()?>" selected><?=$verification->getBonus1()?></option>
                <?php endif; ?>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>

    </div>

    <div>
        <h4>Bonus 2</h4>

        <label for="bonus2">
            <?= $questions->getBonus2() ?>

            <select name="bonus2" id="bonus2">
                <?php if (isset($verification)) : ?>
                    <option value="<?=$verification->getBonus2()?>" selected><?=$verification->getBonus2()?></option>
                <?php endif; ?>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
            
    </div>

    <div>
        <button type="submit">Envoyer la vérification</button>
    </div>

</form>

<button><a href="<?= $router->generate('verification-home') ?>">RETOUR</a></button>
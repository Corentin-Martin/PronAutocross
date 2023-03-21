<h1>Vous jouez pour <?= $race->getName() .  ' - ' . $race->getYearId() ?></h1>

<?php if (!empty($errorList)) : ?>

<div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach($errorList as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>

<form action="" method="post">

    <?php foreach ($categories as $category) :

            $categoryToGet = str_replace(" ", "", $category->getName()); ?>

    <!-- <details> -->

        <summary>

            <h3><?= $category->getName() ?></h3>

        </summary>

        <h4><?= $questions->{'get'.$categoryToGet}() ?></h4>

        <div class = "container">

        <?php foreach ($entrylist[$category->getId()] as $entry) : ?>

            
            <label class="label" for="<?= $entry['driver']->getId() ?>">

                <input type="radio" class="radio" name="<?= $categoryToGet ?>" value="<?= $entry['driver']->getId() ?>" id="<?= $entry['driver']->getId() ?>" required>
                
                <div class="card">

                    <img class="card-img-top" src="<?= $baseURI . $entry['driver']->getPicture() ?>" alt="Card image cap">
                    
                    <div class="card-body">

                        <h3 class=""># <?= $entry['driver']->getNumber() ?></h3>

                        <h2 class=""> <?= $entry['driver']->getFirstName() . " " . $entry['driver']->getLastName() ?></h2>

                        <h4 class=""><?= $entry['driver']->getVehicle() ?></h4>

                        <h5 class=""><?= $entry['rate'] ?></h5>
                    </div>
                </div>
            </label>

        <?php endforeach; ?>

        </div>

    <!-- </details> -->

    <?php endforeach; ?>

        <summary>

            <h3>Bonus 1</h3>

        </summary>

        <h4><?= $questions->getBonus1() ?></h4>

        <select name="bonus1" id="bonus1" required>

            <option value ="oui"> Oui </option>
            <option value ="non"> Non </option>

        </select>

        <summary>

        <h3>Bonus 2</h3>

        </summary>

        <h4><?= $questions->getBonus2() ?></h4>

        <select name="bonus2" id="bonus2" required>

            <option value = "oui"> Oui </option>
            <option value = "non"> Non </option>

        </select>

        <input type="hidden" name="raceId" id="raceId" value="<?= $race->getId() ?>">
        <input type="hidden" name="year" id="year" value="<?= date('Y') ?>">
        <input type="hidden" name="playerId" id="playerId" value="<?= $_SESSION['user']->getId() ?>">

    <button type="submit">ENVOYER</button>

</form>


<h1>ICI ON GENERE LES LISTE DES ENGAGES</h1>

<form method="post" action="">

    <select name="year">

        <?php foreach ($years as $year) : ?>
            <option value="<?= $year->getId() ?>"><?= $year->getId() ?></option>
        <?php endforeach; ?>

    </select>

    <select name="race">

        <?php foreach ($racesById as $race) : ?>
            <option value="<?= $race->getId() ?>"><?= $race->getName() ?></option>
        <?php endforeach; ?>

    </select>

    <?php 
        foreach ($viewData['categories'] as $category) : ?>

        <details>

            <summary>
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?>
            </summary>

    <?php $drivers1 = $driverModel->findAllByCategoryAndStatus1($category->getId());

            foreach ($drivers1 as $driver) : ?>

            <label for="<?= $driver->getId() ?>"> <?= $driver->getNumber(). " - " . $driver->getFirstName() . " " . $driver->getLastName() ?>

                <input type="checkbox" id="<?= $driver->getId() ?>" name = "<?= $driver->getId() ?>" checked>
            
            </label>
            
    <?php   endforeach; ?>

    <?php $drivers1 = $driverModel->findAllByCategoryAndStatus0($category->getId());

            foreach ($drivers1 as $driver) : ?>

            <label for="<?= $driver->getId() ?>"><?= $driver->getNumber(). " - " . $driver->getFirstName() . " " . $driver->getLastName() ?>

                <input type="checkbox" id="<?= $driver->getId() ?>" name = "<?= $driver->getId() ?>">

            </label>
            
    <?php   endforeach; ?>

        </details>

    <?php endforeach; ?>

    <button type="submit">VALIDER LA LISTE DES ENGAGEES</button>
    
</form>

<button><a href="<?= $router->generate('entrylist-home') ?>">RETOUR</a></button>





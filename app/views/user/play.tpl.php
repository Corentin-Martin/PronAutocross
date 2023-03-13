<h1>Vous jouez pour <?= $racesById[$raceId]->getName() .  ' - ' .$year ?></h1>

<form action="" method="get">

    <?php foreach ($categories as $category) :

            $categoryToGet = str_replace(" ", "", $category->getName()); ?>

    <!-- <details> -->

        <summary>

            <h3><?= $category->getName() ?></h3>

        </summary>

        <h4><?= $questions->{'get'.$categoryToGet}() ?></h4>

        <div class = "container">

        <?php foreach ($entrylist[$category->getId()] as $listForCategory) : ?>

            
            <label class="label" for="<?= $listForCategory->getDriverId() ?>">

                <input type="radio" class="radio" name="<?= $categoryToGet ?>" value="<?= $listForCategory->getDriverId() ?>" id="<?= $listForCategory->getDriverId() ?>" required>
                
                <div class="card">

                    <img class="card-img-top" src="<?= $baseURI . $driversById[$listForCategory->getDriverId()]->getPicture() ?>" alt="Card image cap">
                    
                    <div class="card-body">

                        <h3 class=""># <?= $driversById[$listForCategory->getDriverId()]->getNumber() ?></h3>

                        <h2 class=""> <?= $driversById[$listForCategory->getDriverId()]->getFirstName() . " " . $driversById[$listForCategory->getDriverId()]->getLastName() ?></h2>

                        <h4 class=""><?= $driversById[$listForCategory->getDriverId()]->getVehicle() ?></h4>

                        <h5 class=""><?= $rates[$listForCategory->getDriverId()]->getOverall() ?></h5>
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

        <input type="hidden" name="raceId" id="raceId" value="<?= $raceId ?>">
        <input type="hidden" name="year" id="year" value="<?= $year?>">

    <button type="submit">ENVOYER</button>

</form>


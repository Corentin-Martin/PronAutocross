<h1>Vous jouez pour <?= $racesById[$viewData['raceId']]->getName() .  ' - ' .$viewData['year'] ?></h1>

<form action="" method="get">

    <?php foreach ($viewData['categories'] as $category) :

            $categoryToGet = str_replace(" ", "", $category->getName()); ?>

        <h3><?= $viewData['questions']->{'get'.$categoryToGet}() ?></h3>

        <select value="">

            <?php foreach ($viewData['entrylist'][$category->getId()] as $listForCategory) : ?>
    
                <option name="" id="">

                    <?= $driversById[$listForCategory->getDriverId()]->getNumber() . " - " . $driversById[$listForCategory->getDriverId()]->getFirstName() . " " . $driversById[$listForCategory->getDriverId()]->getLastName(); ?>

                </option>



            <?php endforeach; ?>

        </select> 

    <?php endforeach; ?>

</form>


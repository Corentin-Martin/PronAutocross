<?php if (!empty($_POST)) :

$viewData['entryModel']->make($_POST);

$race = $_POST['race'];
$year = $_POST['year']; ?>

<h2> LISTE DES ENGAGEES POUR <?= $racesById[$race]->getName() . ' ' . $year ?> VALIDEE </h2>

<?php 
    foreach ($viewData['categories'] as $category) : ?>

    <div>
    <h3> <?= $category->getName(); ?> </h3>

<?php $listByCategory = $viewData['entryModel']->listByRaceAndCategory($year, $race, $category->getId());

        foreach ($listByCategory as $entry) : ?>
        <p> <?= $driversById[$entry->getDriverId()]->getNumber(). " - " . $driversById[$entry->getDriverId()]->getFirstName() . " " . $driversById[$entry->getDriverId()]->getLastName(); ?> </p>

<?php 
        endforeach; ?>
    </div> 
<?php 
    endforeach; endif; ?>

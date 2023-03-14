<h2>Liste des engagés pour <?= $race[$raceId]->getName() ?> - <?= $year ?></h2>

<?php foreach ($races as $race) : ?>
    <a href="<?= $router->generate('entrylist-list', ['year' => $year, 'id' => $race->getId()]) ?>"><?= $race->getName() ?></a>
<?php endforeach; ?>

<table>
    <thead>
<th>Catégorie</th>
<th>Numéro</th>
<th>Prénom</th>
<th>Nom de famille</th>
    </thead>
    <tbody>



<?php foreach ($entrylist as $entry) : ?>
<tr>
    <td><?= $category[$entry->getCategoryId()]->getName() ?></td>
    <td><?= $driver[$entry->getDriverId()]->getNumber() ?></td>
    <td><?= $driver[$entry->getDriverId()]->getFirstName() ?></td>
    <td><?= $driver[$entry->getDriverId()]->getLastName() ?></td>
    </tr>
<?php endforeach ; ?>

</tbody>
</table>

<button><a href="<?= $router->generate('entrylist-home') ?>">RETOUR</a></button>
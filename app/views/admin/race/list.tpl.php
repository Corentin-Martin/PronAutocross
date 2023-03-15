<h2>Liste des courses - <?= $currentYear ?></h2>
<?php foreach ($years as $year) : ?>
    <a href="<?= $router->generate('race-list', ['year' => $year->getId()]) ?>"><?= $year->getId() ?></a>
<?php endforeach; ?>

<table>
    <thead>
        <th>#</th>
        <th>Epreuve</th>
        <th>Deadline</th>
        <th>Poster</th>
    </thead>
    <tbody>

<?php foreach ($races as $race) : ?>
    <tr>
        <td><?= $race->getId() ?></td>
        <td><?= $race->getName() ?></td>
        <td><?= $race->getDate() ?></td>
        <td><img src="<?= $baseURI . $race->getPoster() ?>" alt="" class="picture-driver"></td>
    </tr>
<?php endforeach; ?>

</tbody>
</table>

<button><a href="<?= $router->generate('race-home') ?>">RETOUR</a></button>
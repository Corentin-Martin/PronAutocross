<h2>Liste des vérifications - <?= $year ?></h2>
<?php foreach ($years as $year) : ?>
    <a href="<?= $router->generate('verification-list', ['year' => $year->getId()]) ?>"><?= $year->getId() ?></a>
<?php endforeach; ?>

<table>
    <thead>
        <th>Epreuve</th>
        <?php foreach ($categories as $category) : ?>
        <th><?= $category->getName() ?></th>
        <?php endforeach; ?>
        <th>Bonus 1</th>
        <th>Bonus 2</th>
    </thead>
    <tbody>

<?php foreach ($verifications as $verification) : ?>
    <tr>
        <td><?= $races[$verification->getRaceId()]->getName() ?></td>
        <td><?= $driversById[$verification->getMaxiSprint()]->getFirstName() . ' ' . $driversById[$verification->getMaxiSprint()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getTourismeCup()]->getFirstName() . ' ' . $driversById[$verification->getTourismeCup()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getSprintGirls()]->getFirstName() . ' ' . $driversById[$verification->getSprintGirls()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getBuggyCup()]->getFirstName() . ' ' . $driversById[$verification->getBuggyCup()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getJuniorSprint()]->getFirstName() . ' ' . $driversById[$verification->getJuniorSprint()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getMaxiTourisme()]->getFirstName() . ' ' . $driversById[$verification->getMaxiTourisme()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getBuggy1600()]->getFirstName() . ' ' . $driversById[$verification->getBuggy1600()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getSuperSprint()]->getFirstName() . ' ' . $driversById[$verification->getSuperSprint()]->getLastName() ?></td>
        <td><?= $driversById[$verification->getSuperBuggy()]->getFirstName() . ' ' . $driversById[$verification->getSuperBuggy()]->getLastName() ?></td>
        <td><?= $verification->getBonus1()?></td>
        <td><?= $verification->getBonus2() ?></td>
    </tr>
<?php endforeach; ?>

</tbody>
</table>

<button><a href="<?= $router->generate('verification-home') ?>">RETOUR</a></button>
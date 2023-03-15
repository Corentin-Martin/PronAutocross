<h2>Liste des questions - <?= $year ?></h2>
<?php foreach ($years as $year) : ?>
    <a href="<?= $router->generate('question-list', ['year' => $year->getId()]) ?>"><?= $year->getId() ?></a>
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

<?php foreach ($questions as $question) : ?>
    <tr>
        <td><?= $races[$question->getRaceId()]->getName() ?></td>
        <td><?= $question->getMaxiSprint() ?></td>
        <td><?= $question->getTourismeCup() ?></td>
        <td><?= $question->getSprintGirls() ?></td>
        <td><?= $question->getBuggyCup() ?></td>
        <td><?= $question->getJuniorSprint() ?></td>
        <td><?= $question->getMaxiTourisme() ?></td>
        <td><?= $question->getBuggy1600() ?></td>
        <td><?= $question->getSuperSprint() ?></td>
        <td><?= $question->getSuperBuggy() ?></td>
        <td><?= $question->getBonus1() ?></td>
        <td><?= $question->getBonus2() ?></td>
    </tr>
<?php endforeach; ?>

</tbody>
</table>

<button><a href="<?= $router->generate('question-home') ?>">RETOUR</a></button>
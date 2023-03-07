<h1> RESULTATS DE <?= $racesById[$viewData['race_id']]->getName() ?></h1>

<table>
    <thead>
    <tr>
    <td>Place</td>
    <td>Pseudo</td>
<td>Maxi Sprint</td>
<td>Tourisme Cup</td>
<td>Sprint Girls</td>
<td>Buggy Cup</td>
<td>Junior Sprint</td>
<td>Maxi Tourisme</td>
<td>Buggy 1600</td>
<td>Super Sprint</td>
<td>Super Buggy</td>
<td>Bonus 1</td>
<td>Bonus 2</td>
<td>Total</td>
</tr>
    </thead>
    <tbody>

<?php

foreach ($viewData['score'] as $score) : dump($score); ?>


<tr>
<td></td>
<td><?= $playersById[$score->getPlayerId()]->getPseudo() ?></td>
<td><?= $score->getMaxiSprint(); ?></td>
<td><?= $score->getTourismeCup(); ?></td>
<td><?= $score->getSprintGirls(); ?></td>
<td><?= $score->getBuggyCup(); ?></td>
<td><?= $score->getJuniorSprint(); ?></td>
<td><?= $score->getMaxiTourisme(); ?></td>
<td><?= $score->getBuggy1600(); ?></td>
<td><?= $score->getSuperSprint(); ?></td>
<td><?= $score->getSuperBuggy(); ?></td>
<td><?= $score->getBonus1(); ?></td>
<td><?= $score->getBonus2(); ?></td>
<td><?= $score->getTotal(); ?></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>
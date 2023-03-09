
<h1> CLASSEMENT GENERAL <?= $viewData['general'][0]->getYearId(); ?> </h1>

<table>
    <thead>
        <tr>
            <td>Place</td>
            <td>Pseudo</td>
            <td>Total</td>
            <?php foreach ($racesById as $race) : ?>
            <td><?= $race->getName() ?></td>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>

<?php
$place=2;
$increment=1;
$preceding = null;
foreach ($viewData['general'] as $general) : ;
 ?>


<tr>
<td><?php if (is_null($preceding) || $preceding === $general->getTotal()) {

    $place--;
    
    echo $place;
    
} else {
    echo $increment;

    $place = $increment;

}
$place++;
$increment++;



$preceding = $general->getTotal(); ?>
</td>
<td><?= $playersById[$general->getPlayerId()]->getPseudo() ?></td>
<td><?= $general->getTotal(); ?></td>

<?php foreach ($racesById as $race) :
    $scores = $scoreModel->sortingForGeneral($viewData['general'][0]->getYearId(), $race->getId(), $general->getPlayerId());



    foreach ($scores as $score) :

?>
            <td><?= $score->getTotal() ?? 0 ; ?></td>
<?php endforeach; endforeach;   ?>


</tr>

<?php endforeach; ?>

</tbody>
</table>
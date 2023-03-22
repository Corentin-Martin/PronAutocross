
<table class="table table-light table-hover table-striped shadow align-middle">
<thead>
    <tr>
        <th <?= (is_null($score)) ? 'colspan="5"' : 'colspan="3"' ?>><h2 class="fw-bold">Votre fiche récap' pour <?= $race->getName() ?> - <?= $race->getYearId() ?></h2></th>
    </tr>
    <th>Catégorie</th>
    <th>Question</th>
    <th>Réponse</th>
    <?php if (is_null($score)) : ?>
    <th>Cote</th>
    <th>Gain potentiel</th>
    <?php endif;?>
</thead>
<tbody>
<?php foreach(array_slice($vote, 0, 9) as $categoryVote) : ?>
<tr <?php if (isset($verification)) {
    if ($verification->{'get'.str_replace(" ", "", $categoryVote['category'])}() === $participation->{'get'.str_replace(" ", "", $categoryVote['category'])}()) : ?> class="table-success" <?php else: ?> class="table-danger" <?php endif; }?> >
    <td class="fw-bold"><?= $categoryVote['category'] ?></td>
    <td><?= $categoryVote['question'] ?></td>
    <td class="fst-italic"><?= $categoryVote['answer']['driver'] ?></td>
    <?php if (is_null($score)) : ?>
    <td><?= $categoryVote['answer']['rate'] ?></td>
    <td><?= $categoryVote['answer']['potential'] ?></td>
    <?php endif; ?>
    </tr>
<?php endforeach; ?>

<?php foreach(array_slice($vote, 9, 11) as $bonusVote) : ?>
<tr <?php if (isset($verification)) {
    if ($verification->{'get'.str_replace(" ", "", $bonusVote['category'])}() === $participation->{'get'.str_replace(" ", "", $categoryVote['category'])}()) : ?> class="table-success" <?php else: ?> class="table-danger" <?php endif; }?>>
    <td class="fw-bold"><?= $bonusVote['category'] ?></td>
    <td><?= $bonusVote['question'] ?></td>
    <td class="fst-italic"><?= $bonusVote['answer'] ?></td>
    <?php if (is_null($score)) : ?>
    <td>/</td>
    <td>20</td>
    <?php endif; ?>
</tr>
<?php endforeach ?>

<?php if (is_null($score)) : ?>
<tr class="table-secondary">
    <td class="fw-bold" colspan="3">Gain potentiel maximum</td>
    <td class="fw-bold fst-italic" colspan="2"><?= $potentialWin ?></td>
</tr>
<?php endif; ?>

<?php if (isset($score)) : ?>
<tr class="table-info">
    <td class="fw-bold" colspan="2">Score final</td>
    <td>
        <a class="btn btn-primary" href="<?= $this->router->generate('results', ['year' => $score->getYearId(), 'id' => $score->getRaceId()]) ?>">
            <?= $score->getTotal() . " (" . $score->getPlace() . (($score->getPlace() == 1) ? "er)" : "ème)") ?>
        </a>
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>
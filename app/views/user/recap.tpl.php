RECAP

<table class="table">
<thead>
    <th>Catégorie</th>
    <th>Question</th>
    <th>Réponse</th>
    <th>Cote</th>
    <th>Gain potentiel</th>
</thead>
<tbody>
<?php foreach(array_slice($vote, 0, 9) as $categoryVote) : ?>
<tr <?php if (isset($verification)) {
    if ($verification->{'get'.str_replace(" ", "", $categoryVote['category'])}() === $participation->{'get'.str_replace(" ", "", $categoryVote['category'])}()) : ?> class="table-success" <?php else: ?> class="table-danger" <?php endif; }?> >
    <td><?= $categoryVote['category'] ?></td>
    <td><?= $categoryVote['question'] ?></td>
    <td><?= $categoryVote['answer']['driver'] ?></td>
    <td><?= $categoryVote['answer']['rate'] ?></td>
    <td><?= $categoryVote['answer']['potential'] ?></td>
    </tr>
<?php endforeach; ?>

<?php foreach(array_slice($vote, 9, 11) as $bonusVote) : ?>
<tr <?php if (isset($verification)) {
    if ($verification->{'get'.str_replace(" ", "", $bonusVote['category'])}() === $participation->{'get'.str_replace(" ", "", $categoryVote['category'])}()) : ?> class="table-success" <?php else: ?> class="table-danger" <?php endif; }?>>
    <td><?= $bonusVote['category'] ?></td>
    <td><?= $bonusVote['question'] ?></td>
    <td colspan="2"><?= $bonusVote['answer'] ?></td>
    <td>20</td>
</tr>
<?php endforeach ?>

<tr class="table-secondary">
    <td colspan="3">Gain potentiel maximum</td>
    <td colspan="2"><?= $potentialWin ?></td>
</tr>

<?php if (isset($score)) : ?>
<tr class="table-info">
    <td colspan="3">Gain réel</td>
    <td colspan="2">
        <a href="<?= $this->router->generate('results', ['year' => $score->getYearId(), 'id' => $score->getRaceId()]) ?>">
            <?= $score->getTotal() . " (" . $score->getPlace() . (($score->getPlace() == 1) ? "er)" : "ème)") ?>
        </a>
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>
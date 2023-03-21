RECAP

<table class="table">

<tbody>
<?php foreach(array_slice($vote, 0, 9) as $categoryVote) : ?>
<tr>
    <td><?= $categoryVote['category'] ?></td>
    <td><?= $categoryVote['question'] ?></td>
    <td><?= $categoryVote['answer']['driver'] ?></td>
    <td><?= $categoryVote['answer']['rate'] ?></td>
    <td><?= $categoryVote['answer']['potential'] ?></td>
    </tr>
<?php endforeach; ?>

<?php foreach(array_slice($vote, 9, 11) as $bonusVote) : ?>
<tr>
    <td><?= $bonusVote['category'] ?></td>
    <td><?= $bonusVote['question'] ?></td>
    <td colspan="2"><?= $bonusVote['answer'] ?></td>
    <td>20</td>
</tr>
<?php endforeach ?>

<tr>
    <td colspan="4">Gain potentiel</td>
    <td><?= $potentialWin ?></td>
</tr>
</tbody>
</table>
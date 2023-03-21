
<div class="row m-auto">
    <div class="col-12 overflow-auto">
    <table class="table table-primary  table-hover table-striped">
        <thead class="table-dark">

            <tr>
                <th colspan="13"><h2 class="fw-bold">Classement général <?= $year ?></h2></th>
            </tr>

                <th>Place</th>
                <th>Pseudo</th>
                <th>Total</th>

                <?php foreach ($races as $race) : ?>
                <th><?= $race->getName() ?></th>
                <?php endforeach; ?>

        </thead>

        <tbody>

            <?php foreach ($players as $player) : ; ?>

            <tr <?= (isset($_SESSION['user']) && ($_SESSION['user']->getPseudo() === $player['fiche']->getPseudo())) ? 'class="table-warning"' : "" ?>
            <?= ($player['place'] == 1) ? 'class="table-success"' : "" ?>>
                <td class="table-info fst-italic">
                   <?= $player['place'] ?>
                </td>

                <td class="fw-bold"><?= $player['fiche']->getPseudo() ?></td>

                <td class="table-success fw-bold"><?= $player['general'] ?></td>

                <?php foreach ($races as $race) : ?>

                <td><?= ($player['scores'][$race->getId()]) ? $player['scores'][$race->getId()]->getTotal() : '/' ?></td>

                <?php  endforeach;  ?>
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
    </div>
</div>
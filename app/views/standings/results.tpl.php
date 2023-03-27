
<div class="dropdown text-center mt-3">
    <a class="btn btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</a>
    <ul class="dropdown-menu">
        <?php foreach ($races as $nextRace) : ?>
        <li><a class="dropdown-item" href="<?= $this->router->generate('results', ['year' => $year, 'id' => $nextRace->getId()]) ?>"><?= $nextRace->getName() ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="row mt-3">
    <div class="col-12 overflow-auto">
        <table class="table table-primary  table-hover table-striped shadow align-middle">
            <thead class="table-dark">
                <tr>
                    <th colspan="14"><h2 class="fw-bold">Résultats de <?= $race->getName() ?> - <?= $race->getYearId() ?></h2></th>
                </tr>
                <th>Place</th>
                <th>Pseudo</th>
                <th>Total</th>
                <?php foreach ($categories as $category) : ?>
                    <th><?= $category->getName() ?></th>
                <?php endforeach; ?>
                <th>Bonus 1</th>
                <th>Bonus 2</th>
            </thead>
            <tbody>
                <?php if (!empty($players)) : ?>
                    <?php foreach ($players as $player) : ?>
                        <tr <?= (isset($_SESSION['user']) && ($_SESSION['user']->getPseudo() === $player['fiche']->getPseudo())) ? 'class="table-warning"' : "" ?>
                        <?= ($player['place'] == 1) ? 'class="table-success"' : "" ?>>
                            <td class="table-info fst-italic"><?= $player['place'] ?></td>
                            <td class="fw-bold"><?= $player['fiche']->getPseudo() ?></td>
                            <td class="table-success fw-bold"><?= $player['score']->getTotal(); ?></td>
                            <?php foreach ($categories as $category) : $categoryToGet = str_replace(" ", "", $category->getName()); ?>
                                <td><?= $player['score']->{'get'.$categoryToGet}(); ?></td>
                            <?php endforeach; ?>
                            <td><?= $player['score']->getBonus1(); ?></td>
                            <td><?= $player['score']->getBonus2(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="14">Pas encore de résultats pour cette épreuve...</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
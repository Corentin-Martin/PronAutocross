<h1> RESULTATS DE <?= $race->getName() ?></h1>

    <table class="table">
        <thead>
            <tr>
                <td>Place</td>
                <td>Pseudo</td>

                <?php foreach ($categories as $category) : ?>
                <td><?= $category->getName() ?></td>
                <?php endforeach; ?>

                <td>Bonus 1</td>
                <td>Bonus 2</td>
                <td>Total</td>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($players as $player) : ?>

            <tr <?= (isset($_SESSION['user']) && ($_SESSION['user']->getPseudo() === $player['fiche']->getPseudo())) ? 'class="table-warning"' : "" ?>>
                <td>
                 <?= $player['place'] ?>
                </td>

                <td><?= $player['fiche']->getPseudo() ?></td>
                
                <?php foreach ($categories as $category) :
                $categoryToGet = str_replace(" ", "", $category->getName()); ?>
                <td><?= $player['score']->{'get'.$categoryToGet}(); ?></td>
                <?php endforeach; ?>

                <td><?= $player['score']->getBonus1(); ?></td>
                <td><?= $player['score']->getBonus2(); ?></td>
                <td><?= $player['score']->getTotal(); ?></td>
            </tr>

            <?php endforeach; ?>

        </tbody>
        
    </table>
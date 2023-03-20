
<h1> CLASSEMENT GENERAL <?= $year ?> </h1>

    <table>
        <thead>
            <tr>
                <td>Place</td>
                <td>Pseudo</td>
                <td>Total</td>

                <?php foreach ($races as $race) : ?>
                <td><?= $race->getName() ?></td>
                <?php endforeach; ?>

            </tr>
        </thead>

        <tbody>

            <?php foreach ($players as $player) : ; ?>

            <tr>
                <td>
                   <?= $player['place'] ?>
                </td>

                <td><?= $player['fiche']->getPseudo() ?></td>

                <td><?= $player['general'] ?></td>

                <?php foreach ($races as $race) : ?>

                <td><?= ($player['scores'][$race->getId()]) ? $player['scores'][$race->getId()]->getTotal() : '/' ?></td>

                <?php  endforeach;  ?>
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
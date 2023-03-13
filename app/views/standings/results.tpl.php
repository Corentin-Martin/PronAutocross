<h1> RESULTATS DE <?= $racesById[$viewData['race_id']]->getName() ?></h1>

    <table>
        <thead>
            <tr>
                <td>Place</td>
                <td>Pseudo</td>

                <?php foreach ($viewData['categories'] as $category) : ?>
                <td><?= $category->getName() ?></td>
                <?php endforeach; ?>

                <td>Bonus 1</td>
                <td>Bonus 2</td>
                <td>Total</td>
            </tr>
        </thead>

        <tbody>

            <?php $place=2; $increment=1; $preceding = null;
            foreach ($viewData['score'] as $score) : ; ?>

            <tr>
                <td>
                    <?php if (is_null($preceding) || $preceding === $score->getTotal()) {

                        $place--;
                        echo $place;

                    } else {

                        echo $increment;
                        $place = $increment;

                    }

                    $place++; $increment++; $preceding = $score->getTotal(); ?>
                </td>

                <td><?= $playersById[$score->getPlayerId()]->getPseudo() ?></td>
                
                <?php foreach ($viewData['categories'] as $category) :
                $categoryToGet = str_replace(" ", "", $category->getName()); ?>
                <td><?= $score->{'get'.$categoryToGet}(); ?></td>
                <?php endforeach; ?>

                <td><?= $score->getBonus1(); ?></td>
                <td><?= $score->getBonus2(); ?></td>
                <td><?= $score->getTotal(); ?></td>
            </tr>

            <?php endforeach; ?>

        </tbody>
        
    </table>
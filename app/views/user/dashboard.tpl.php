    <div>
        <h3>Classement général</h3>
        <p><?= $general->getTotal() ?> points</p>
    </div>

    <h3>Course par course</h3>
<?php foreach ($scores as $score) : ?>


    <div> <?= $racesById[$score->getRaceId()]->getName() ?> - 
    <?= $score->getTotal() ?> points </div>

<?php endforeach; ?>
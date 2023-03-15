<h2>Générer les questions</h2>

<form action="" method="post">
        <div>
            <label for="year">
                <h4>Année</h4>
                <select name="year" id="year" required>
                    <?php foreach ($years as $year) : ?>
                        <option value="<?= $year->getId() ?>"><?= $year->getId() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div>
            <label for="raceId">
                <h4>Course</h4>
                <select name="raceId" id="raceId" required>
                    <?php foreach ($races as $race) : ?>
                        <option value="<?= $race->getId() ?>"><?= $race->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>

    <?php foreach ($categories as $category) : ?>
        <div>
            <label for="<?= $category->getId() ?>">
                <h4><?= $category->getName() ?></h4>
                <input type="text" name="<?= $category->getName() ?>" id="<?= $category->getId() ?>" placeholder="Question pour <?= $category->getName() ?>" size="60" required>
            </label>
        </div>
    <?php endforeach; ?>
        <div>
            <label for="bonus1">
                <h4>Bonus 1</h4>
                <input type="text" name="bonus1" id="bonus1" placeholder="Question Bonus 1" size="60" required>
            </label>
        </div>
        <div>
            <label for="bonus2">
                <h4>Bonus 2</h4>
                <input type="text" name="bonus2" id="bonus2" placeholder="Question Bonus 2" size="60" required>
            </label>
        </div>
        <div>
            <button type="submit">Générer les questions</button>
        </div>
</form>

<button><a href="<?= $router->generate('question-home') ?>">RETOUR</a></button>
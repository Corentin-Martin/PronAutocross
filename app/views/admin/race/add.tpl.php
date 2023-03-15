<h2>Ajouter une nouvelle course</h2>

<form action="" method="post">
    <div>
        <label for="year">
            <select name="year" id="year">
                <?php foreach ($years as $year) : ?>
                    <option value="<?= $year->getId() ?>"><?= $year->getId() ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <div>
        <label for="name">
            <h4>Nom de l'épreuve</h4>
            <input type="text" name="name" id="name" placeholder="Lieu de l'épreuve" size="60" required>
        </label>
    </div>
    <div>
        <label for="date">
            <h4>Date</h4>
            <input type="datetime-local" name="date" id="date" value="2023-01-01 08:45" required>
        </label>
    </div>
    <div>
        <label for="poster">
            <h4>Poster</h4>
            <input type="file" name="poster" id="poster" accept="image/png, image/jpg">
        </label>
    </div>
    <div>
        <button type="submit">ENVOYER</button>
    </div>
</form>


<button><a href="<?= $router->generate('race-home') ?>">RETOUR</a></button>

<div class="admin__container">

<?php if ($race) : ?>
    <h2 class="admin__container__title">Editer la course</h2>
<?php else : ?>
    <h2 class="admin__container__title">Créer une nouvelle course</h2>
<?php endif; ?>

    <div>
    <form action="" method="post">
    <div class="form-group">
        <label for="year">
            <select name="year" id="year">
                <?php foreach ($years as $year) : ?>
                    <option value="<?= $year->getId() ?>"><?= $year->getId() ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <div class="form-group">
        <label for="name">Nom de l'épreuve
            <input class="form-control" type="text" name="name" id="name" placeholder="Lieu de l'épreuve" size="60" <?= ($race) ? "value = \" {$race->getName()} \"" : "" ?>required>
        </label>
    </div>
    <div class="form-group">
        <label for="date">Date
            <input class="form-control" type="datetime-local" name="date" id="date" value="2023-01-01 08:45" <?= ($race) ? "value = \" {$race->getDate()} \"" : "value=\"2023-01-01 08:45\"" ?>required>
        </label>
    </div>
    <div class="form-group">
        <label for="poster">Poster
            <input class="form-control" type="file" name="poster" id="poster" accept="image/png, image/jp g<?= ($race) ? "value = \" {$race->getPoster()} \"" : "" ?> ">
        </label>
    </div>
    
    <div class="form-group">
    <button class="btn btn-success btn-lg" type="submit">
        <?php if ($race) : ?>
            Editer cette course
        <?php else : ?>
            Créer une nouvelle course
        <?php endif; ?>
    </button>
    </div>

</form>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('race-home') ?>">RETOUR</a>
    </div>


</div>
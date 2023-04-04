<div class="row mt-3 justify-content-center">

    <?php if ($race) : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer la course</h2>
    <?php else : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Créer une nouvelle course</h2>
    <?php endif; ?>

    <div class="col-12">
        <form action="" method="post">
            <div class="form-group">
                <label class="col-8 text-primary fw-bold bg-light shadow border border-primary p-2 mt-2" for="year">
                    <select name="year" id="year">
                        <?php foreach ($years as $year) : ?>
                            <option value="<?= $year->getId() ?>"><?= $year->getId() ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary fw-bold bg-light shadow border border-primary p-2 mt-2" for="name">Nom de l'épreuve
                    <input class="form-control" type="text" name="name" id="name" placeholder="Lieu de l'épreuve" size="60" <?= ($race) ? "value = \" {$race->getName()} \"" : "" ?>required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary fw-bold bg-light shadow border border-primary p-2 mt-2" for="date">Date
                    <input class="form-control" type="datetime-local" name="date" id="date" <?= ($race) ? "value = \" {date('Y-m-d H:i:s', {$race->getDate()})} \"" : "value=\"2023-01-01 08:45\"" ?>required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary fw-bold bg-light shadow border border-primary p-2 mt-2" for="poster">Poster
                    <input class="form-control" type="file" name="poster" id="poster" accept="image/png, image/jp g<?= ($race) ? "value = \" {$race->getPoster()} \"" : "" ?> ">
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg mt-3 col-6" type="submit">
                    <?php if ($race) : ?>
                        Editer cette course
                    <?php else : ?>
                        Créer une nouvelle course
                    <?php endif; ?>
                </button>
            </div>

            <?php $token = $_SESSION['token'] = random_bytes(5); ?>
            <input type="hidden" name="token" value="<?= $token ?>">
        </form>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('race-home') ?>">RETOUR</a>

</div>
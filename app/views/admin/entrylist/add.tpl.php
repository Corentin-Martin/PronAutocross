<div class="row mt-3 justify-content-center">
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Création d'une liste des engagés</h2>

    <div class="col-12">
        <form method="post" action="">
            <input type="hidden" name="year" value="<?= date('Y') ?>">
            <div class="form-group">
                <select name="race">
                    <?php foreach ($races as $race) : ?>
                        <option value="<?= $race->getId() ?>"><?= $race->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="accordion" id="accordionExample">
                <?php foreach ($categories as $category) : ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $category->getId() ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $category->getId() ?>" aria-expanded="true" aria-controls="collapse<?= $category->getId() ?>">
                                <?= $category->getName() ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $category->getId() ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $category->getId() ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php foreach ($prioritaires[$category->getId()] as $driver) : ?>
                                    <div class="form-check form-switch">
                                        <label for="<?= $driver->getId() ?>" class="form-check-label"> <?= $driver->getNumber(). " - " . $driver->getFirstName() . " " . $driver->getLastName() ?>
                                            <input class="form-check-input" type="checkbox" role="switch"  id="<?= $driver->getId() ?>" name = "<?= $driver->getId() ?>" checked>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                <?php foreach ($invites[$category->getId()] as $driver) : ?>
                                    <div class="form-check form-switch">
                                        <label for="<?= $driver->getId() ?>" class="form-check-label"><?= $driver->getNumber(). " - " . $driver->getFirstName() . " " . $driver->getLastName() ?>
                                            <input class="form-check-input" type="checkbox" role="switch" id="<?= $driver->getId() ?>" name = "<?= $driver->getId() ?>">
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="btn btn-success btn-lg mt-3 col-8"type="submit">VALIDER LA LISTE DES ENGAGES</button>
            <?php $token = $_SESSION['token'] = random_bytes(5); ?>
            <input type="hidden" name="token" value="<?= $token ?>">
        </form>
    </div>
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('entrylist-home') ?>">Retour</a>
</div>






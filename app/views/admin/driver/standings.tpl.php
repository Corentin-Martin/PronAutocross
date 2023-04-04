<div class="row mt-3 justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Mise à jour des classements</h2>

    <?php if (!empty($errorList)) : ?>
        <div class="alert alert-danger col-8 m-auto" role="alert">
            <ul>
                <?php foreach($errorList as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="col-12">
        <form action="" method="post">
            <div class="row d-flex justify-content-around">
                <?php foreach ($categories as $category) : ?>
                    <div class="row col-5 bg-light d-flex justify-content-center mt-3 m-1 p-2 rounded-4 border border-dark shadow">
                        <h4 class="col-12 bg-primary rounded-4 shadow fw-bold p-2 mt-3"><?=$category->getName() ?></h4>
                        <div class="col-12">
                            <?php for ($index = 1; $index < 11; $index ++) : ?>
                                <div class="form-group text-center">
                                    <label for="place<?= $index ?>"><?= $index ?><?= ($index === 1) ? 'er' : 'ème' ?></label>
                                    <select class="form-control text-center" id="place<?= $index ?>" name="place[<?=$category->getId() ?>][<?= $index ?>]">
                                        <option value="">choisissez :</option>
                                        <?php foreach ($drivers[$category->getId()] as $driver) : ?>
                                            <option value="<?= $driver->getId() ?>" <?= ($driver->getPlace() == $index) ? 'selected' : '' ?>><?= $driver->getNumber() . " - " . $driver->getFirstName() . " " . $driver->getLastName() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $token = $_SESSION['token'] = random_bytes(5); ?>
            <input type="hidden" name="token" value="<?= $token ?>">
            <button class="btn btn-success mt-3 col-8" type="submit">METTRE A JOUR LES CLASSEMENTS</button>
        </form>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('driver-home') ?>">RETOUR</a>
    
</div>
                                     
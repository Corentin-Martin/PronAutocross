<?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger col-12 col-sm-8 m-auto" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="admin__container">
    <form action="" method="post">
        <div class="row d-flex justify-content-around">
            <?php foreach ($categories as $category) : ?>
                <div class="row col-12 col-sm-5 bg-light d-flex justify-content-center mt-3 m-1 p-2 rounded-4">
                    <h4 class="col-8"><?=$category->getName() ?></h4>
                    <div class="col-6">
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
        <button class="btn btn-success" type="submit">METTRE A JOUR LES CLASSEMENTS</button>
    </form>
</div>
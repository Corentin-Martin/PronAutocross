
<div class="admin__container">

<?php if ($driver) : ?>
    <h2 class="admin__container__title">Editer le pilote</h2>
<?php else : ?>
    <h2 class="admin__container__title">Générer une fiche pilote</h2>
<?php endif; ?>

<?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger col-12 col-sm-8 m-auto" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <div>
    <form action="" method="post">
    <div class="form-group">
    <label for="firstName"> Prénom

        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Prénom" <?= ($driver) ? "value = \" {$driver->getFirstName()} \"" : "" ?>required>

    </label>
    </div>
    <div class="form-group">
    <label for="lastName"> Nom de famille

        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Nom de famille" <?= ($driver) ? "value = \" {$driver->getLastName()} \"" : "" ?> required>

    </label>
    </div>
    <div class="form-group">
    <label for="number"> Numéro

        <input type="number" class="form-control" name="number" id="number" placeholder="Numéro de course" <?= ($driver) ? "value = \"{$driver->getNumber()}\"" : "" ?>required>
    
    </label>
    </div>
    <div class="form-group">
    <label for="vehicle"> Véhicule

        <input type="text" class="form-control" name="vehicle" id="vehicle" placeholder="Véhicule" <?= ($driver) ? "value = \" {$driver->getVehicle()} \"" : "" ?>required>

    </label>
    </div>
    <div class="form-group">
    <label for="picture"> Photo

        <input type="file" class="form-control" name="picture" id="picture" accept="image/png, image/jpg">
    
    </label>
    </div>
    <div class="form-group">
    <label for="category"> Catégorie

        <select class="form-control" name="category" id="category" required>
            <?php if ($driver) : ?>
            <option value="<?= $driver->getCategoryId() ?>"><?= $categories[$driver->getCategoryId()]->getName() ?></option>
            <?php endif; ?>
            <?php foreach ($categories as $category) : ?>
                <option value = "<?= $category->getId() ?>"> <?= $category->getName() ?></option>
            <?php endforeach; ?>

        </select>

    </label>
    </div>
    <div class="form-group">
    <label for="status"> Statut
        
        <select class="form-control" name="status" id="status" required>

            <?php if ($driver) : ?>
            <option value="<?= $driver->getStatus() ?>"><?= ($driver->getStatus() === 1) ? 'Prioritaire' : 'Invité' ?></option>
            <?php endif; ?>
            <option value= "1">Prioritaire </option>
            <option value= "0">Invité</option>

        </select>

    </label>
    </div>
    <div class="form-group">
    <label for="place"> Position au championnat

        <input type="place" class="form-control" name="place" id="place" placeholder="Place" <?= ($driver) ? "value = \"{$driver->getPlace()}\"" : "value=\"0\"" ?>required>
    
    </label>
    </div>
    <div class="form-group">
    <label for="rate1"> Cote 1

        <input type="rate1" class="form-control" name="rate1" id="rate1" placeholder="Cote 1" <?= ($driver) ? "value = \"{$driver->getRate1()}\"" : "value=\"10\"" ?>required>
    
    </label>
    </div>
    <div class="form-group">
    <label for="rate2"> Cote 2

        <input type="rate2" class="form-control" name="rate2" id="rate2" placeholder="Cote 2" <?= ($driver) ? "value = \"{$driver->getRate2()}\"" : "value=\"10\"" ?>required>
    
    </label>
    </div>
    <div class="form-group">
    <label for="overall"> Cote affinée

        <input type="overall" class="form-control" name="overall" id="overall" placeholder="Cote affinée" <?= ($driver) ? "value = \"{$driver->getOverall()}\"" : "value=\"10\"" ?>required>
    
    </label>
    </div>
    <div class="form-group">
    <button class="btn btn-success btn-lg" type="submit">
        <?php if ($driver) : ?>
            Editer ce pilote
        <?php else : ?>
            Valider ce nouveau pilote
        <?php endif; ?>
    </button>
    </div>

    <?php $token = $_SESSION['token'] = random_bytes(5); ?>
    <input type="hidden" name="token" value="<?= $token ?>">

</form>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('driver-home') ?>">RETOUR</a>
    </div>


</div>
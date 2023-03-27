
<div class="admin__container">

<?php if ($driver) : ?>
    <h2 class="admin__container__title">Editer le pilote</h2>
<?php else : ?>
    <h2 class="admin__container__title">Générer une fiche pilote</h2>
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
    <label for="firstName"> Numéro

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
    <button class="btn btn-success btn-lg" type="submit">
        <?php if ($driver) : ?>
            Editer ce pilote
        <?php else : ?>
            Valider ce nouveau pilote
        <?php endif; ?>
    </button>
    </div>

</form>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('driver-home') ?>">RETOUR</a>
    </div>


</div>
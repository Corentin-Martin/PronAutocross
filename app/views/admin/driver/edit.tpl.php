<h3>MODIFICATION D'UNE FICHE PILOTE</h3>

<form action="" method="post">

    <label for="firstName"> Prénom

        <input type="text" name="firstName" id="firstName" value="<?= $driver->getFirstName() ?>" placeholder="Prénom" required>

    </label>

    <label for="lastName"> Nom de famille

        <input type="text" name="lastName" id="lastName" value="<?= $driver->getLastName() ?>"placeholder="Nom de famille" required>

    </label>

    <label for="firstName"> Numéro

        <input type="number" name="number" id="number" value="<?= $driver->getNumber() ?>"placeholder="Numéro de course" required>
    
    </label>

    <label for="vehicle"> Véhicule

        <input type="text" name="vehicle" id="vehicle" value="<?= $driver->getVehicle() ?>"placeholder="Véhicule" required>

    </label>

    <label for="picture"> Photo

        <input type="file" name="picture" id="picture" value="<?= $driver->getPicture() ?>" accept="image/png, image/jpg">
    
    </label>

    <label for="category"> Catégorie

        <select name="category" id="category" required>
            <option value="<?= $driver->getCategoryId() ?>" selected ><?= $categoriesById[$driver->getCategoryId()]->getName() ?></option>
            <?php foreach ($viewData['categoriesById'] as $category) : ?>
                <option value = "<?= $category->getId() ?>"> <?= $category->getName() ?></option>
            <?php endforeach; ?>

        </select>

    </label>

    <label for="status"> Statut
        
        <select name="status" id="status" required>
            <option value= "<?= $driver->getStatus() ?>" selected><?= ($driver->getStatus() == 1) ? 'Prioritaire' : 'Invité' ?></option>
            <option value= "1">Prioritaire </option>
            <option value= "0">Invité</option>

        </select>

    </label>


    <button type="submit">Modifier ce pilote</button>

</form>

<button><a href="<?= $this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">RETOUR</a></button>

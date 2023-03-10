<h3>ICI ON CREE UN PILOTE</h3>

<form action="" method="get">

    <label for="firstName"> Prénom

        <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>

    </label>

    <label for="lastName"> Nom de famille

        <input type="text" name="lastName" id="lastName" placeholder="Nom de famille" required>

    </label>

    <label for="firstName"> Numéro

        <input type="number" name="number" id="number" placeholder="Numéro de course" required>
    
    </label>

    <label for="vehicle"> Véhicule

        <input type="text" name="vehicle" id="vehicle" placeholder="Véhicule" required>

    </label>

    <label for="picture"> Photo

        <input type="file" name="picture" id="picture" accept="image/png, image/jpg">
    
    </label>

    <label for="category"> Catégorie

        <select name="category" id="category" required>

            <?php foreach ($viewData['categories'] as $category) : ?>
                <option value = "<?= $category->getId() ?>"> <?= $category->getName() ?></option>
            <?php endforeach; ?>

        </select>

    </label>

    <label for="status"> Statut
        
        <select name="status" id="status" required>

            <option value= "1">Prioritaire </option>
            <option value= "0">Invité</option>

        </select>

    </label>

    <button type="submit">Valider ce nouveau pilote</button>

</form>

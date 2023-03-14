Trier par :
<h3>TOUS LES PILOTES</h3>
    <a href="<?= $router->generate('driver-list', ['action' => 'id']) ?>">Id</a>
    <a href="<?= $router->generate('driver-list', ['action' => 'firstName']) ?>">Prénom</a>
    <a href="<?= $router->generate('driver-list', ['action' => 'lastName']) ?>">Nom de famille</a>
    <a href="<?= $router->generate('driver-list', ['action' => 'number']) ?>">Numéro</a>
    <a href="<?= $router->generate('driver-list', ['action' => 'vehicle']) ?>">Véhicule</a>
    <a href="<?= $router->generate('driver-list', ['action' => 'status']) ?>">Statut</a>

    <h3>CHERCHER PAR CATEGORIE</h3>

    <form action="" method="post">
    <select name="categoryId" id="">
    <?php foreach ($categoriesById as $category) : ?>
            <option value="<?= $category->getId()?>"><?= $category->getName() ?></option>
    <?php endforeach; ?>
    </select>
    <select name="action" id="">
        <option value="id">Id</option>
        <option value="firstName">Prénom</option>
        <option value="lastName">Nom de famille</option>
        <option value="number">Numéro</option>
        <option value="vehicle">Véhicule</option>
        <option value="status">Status</option>
    </select>
    <button type="submit">TRIER</button>
    </form>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Prénom</th>
            <th>Nom de famille</th>
            <th>Numéro</th>
            <th>Véhicule</th>
            <th>Photo</th>
            <th>Catégorie</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($drivers as $driver) : ?>
<tr>
    <td><?= $driver->getId()?></td>
    <td><?= $driver->getFirstName() ?></td>
    <td><?= $driver->getLastName() ?></td>
    <td><?= $driver->getNumber() ?></td>
    <td><?= $driver->getVehicle() ?></td>
    <td><img src="<?= $baseURI .$driver->getPicture() ?>" alt="" class="picture-driver"></td>
    <td><?= $categoriesById[$driver->getcategoryId()]->getName() ?></td>
    <td><?= ($driver->getstatus() == 1) ? 'Prioritaire' : 'Invité' ?></td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
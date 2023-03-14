<ul>
    <?php foreach ($categoriesById as $category) : ?>

            <li><a href="<?= $router->generate('driver-list', ['categoryId' => $category->getId(), 'action' => $action]) ?>"><?= $category->getName() ?></a></li>
    <?php endforeach; ?>
    </ul>


Trier par :
<h3>TOUS LES PILOTES</h3>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'id']) ?>">Id</a>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'firstName']) ?>">Prénom</a>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'lastName']) ?>">Nom de famille</a>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number']) ?>">Numéro</a>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'vehicle']) ?>">Véhicule</a>
    <a href="<?= $router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'status']) ?>">Statut</a>

    <h3>CHERCHER PAR CATEGORIE</h3>





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
            <th>Editer</th>
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
    <td class="text-end">
                        <a href="<?= $router->generate('driver-edit', ['id' => $driver->getId()]) ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true">EDITER</i>
                        </a>
</td>
</tr>

<?php endforeach; ?>
</tbody>
</table>

<button><a href="<?= $router->generate('driver-home') ?>">RETOUR</a></button>
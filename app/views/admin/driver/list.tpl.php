<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="admin__container">
    
    <div>
        <h2 class="admin__container__title">Liste des pilotes</h2>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($categoriesById as $category) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $category->getId(), 'action' => $action]) ?>"><?= $category->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Trier par</button>
            
            <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'id']) ?>">Id</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'firstName']) ?>">Prénom</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'lastName']) ?>">Nom de famille</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number']) ?>">Numéro</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'vehicle']) ?>">Véhicule</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'status']) ?>">Statut</a></li>

            </ul>
    </div>

    <div>
        <table class="table table-light table-stripped table-striped-columns table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Prénom</th>
            <th>Nom de famille</th>
            <th>Numéro</th>
            <th>Véhicule</th>
            <!-- <th>Photo</th> -->
            <th>Catégorie</th>
            <th>Statut</th>
            <th>Cote</th>
            <th>Editer</th>
            <th>Supprimer</th>
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
    <!-- <td><img src="<?= $baseURI .$driver->getPicture() ?>" alt="" class="picture-driver"></td> -->
    <td><?= $categoriesById[$driver->getcategoryId()]->getName() ?></td>
    <td><?= ($driver->getstatus() == 1) ? 'Prioritaire' : 'Invité' ?></td>
    <td><?= $rate[$driver->getId()]->getOverall()  ?></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Editer</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= $this->router->generate('driver-edit', ['id' => $driver->getId()]) ?>">Editer la fiche pilote</a></li>
                    <li><a class="dropdown-item" href="TODO">Editer la cote</a></li>
                </ul>
        </div>
    </td>
    <td>
        <div class="dropdown">
            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Supprimer
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Non</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-delete', ['id' => $driver->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
            </ul>
        </div>
    </td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
    </div>


    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('driver-home') ?>">Retour</a>
    </div>


</div>

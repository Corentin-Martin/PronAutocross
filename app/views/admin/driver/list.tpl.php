<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des pilotes</h2>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</button>
        <ul class="dropdown-menu">
            <?php foreach ($categoriesById as $category) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $category->getId(), 'action' => $action]) ?>"><?= $category->getName() ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Trier par</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'id']) ?>">Id</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'firstName']) ?>">Prénom</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'lastName']) ?>">Nom de famille</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number']) ?>">Numéro</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'vehicle']) ?>">Véhicule</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'status']) ?>">Statut</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'place']) ?>">Place</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'overall']) ?>">Cote</a></li>
        </ul>
    </div>

    <a type="button" class="btn btn-outline-success btn-lg mt-3 col-8 shadow"  href="<?= $this->router->generate('driver-add') ?>">Ajouter un pilote</a>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Numéro</th>
                    <th>Véhicule</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Place</th>
                    <th>Cote 1</th>
                    <th>Cote 2</th>
                    <th>Cote globale</th>
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
                        <td><?= $categoriesById[$driver->getcategoryId()]->getName() ?></td>
                        <td><?= ($driver->getstatus() == 1) ? 'Prioritaire' : 'Invité' ?></td>
                        <td><?= $driver->getPlace()  ?></td>
                        <td><?= $driver->getRate1()  ?></td>
                        <td><?= $driver->getRate2()  ?></td>
                        <td><?= $driver->getOverall()  ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('driver-edit', ['id' => $driver->getId()]) ?>">Modifier</a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Supprimer</button>
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

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('driver-home') ?>">Retour</a>

</div>

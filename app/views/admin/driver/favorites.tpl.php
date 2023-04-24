<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des favoris</h2>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</button>
        <ul class="dropdown-menu">
            <?php foreach ($categories as $category) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-showByRate', ['categoryId' => $category->getId()]) ?>"><?= $category->getName() ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-secondary table-striped-columns table-hover table-bordered border-dark table-sm ">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Pilote</th>
                    <th>Véhicule</th>
                    <th>Cote</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver) : if ($driver->getOverall() == 0) { continue; } ?>
                    <tr>
                        <td>#<?= $driver->getNumber() ?></td>
                        <td class="fw-bold"><?= $driver->getFirstName() ?> <?= $driver->getLastName() ?></td>
                        <td class="fst-italic"><?= $driver->getVehicle() ?></td>
                        <td class="fw-bold"><?= $driver->getOverall()  ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('driver-home') ?>">Retour</a>

</div>

<div class="dropdown text-center mt-3">
    <a class="btn btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</a>
    <ul class="dropdown-menu">
        <?php foreach ($categories as $category) : ?>
        <li><a class="dropdown-item" href="<?= $this->router->generate('drivers', ['id' => $category->getId()]) ?>"><?= $category->getName() ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="row mt-3">
    <div class="col-12 overflow-auto">
        <table class="table table-light  table-hover table-striped shadow align-middle">
            <thead class="table-dark">
                <tr>
                    <th colspan="14"><h2 class="fw-bold"> Les cotes des pilotes prioritaires - <?= $currentCategory->getName() ?></h2></th>
                </tr>
                <tr>
                    <th>Numéro</th>
                    <th>Pilote</th>
                    <th>Véhicule</th>
                    <th>Place au championnat</th>
                    <th>Cote</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver) : if ($driver->getOverall() == 0) { continue; } if ($driver->getId() == 9 ) { continue; } ?>
                    <tr>
                        <td>#<?= $driver->getNumber() ?></td>
                        <td class="fw-bold"><?= $driver->getFirstName() ?> <?= $driver->getLastName() ?></td>
                        <td class="fst-italic"><?= $driver->getVehicle() ?></td>
                        <td <?= ($driver->getPlace() > 0) ? 'class="fw-bold fst-italic"' : '' ?>><?= ($driver->getPlace() > 0) ? $driver->getPlace() : '>10' ?></td>
                        <td class="fw-bold"><?= $driver->getOverall()  ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
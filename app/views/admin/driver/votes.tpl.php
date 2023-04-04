
<div class="row mt-3 justify-content-center">

    <div class="btn-group col-7 mt-2" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($races as $race) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-showVotes', ['categoryId' => $currentCategory->getId(), 'raceId' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
    </div>
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2 mt-3 ">Votes par pilote pour <?= $currentRace->getName() ?> - <?= $currentCategory->getName() ?></h2>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</button>
        <ul class="dropdown-menu">
            <?php foreach ($categories as $category) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('driver-showVotes', ['categoryId' => $category->getId(), 'raceId' => $currentRace->getId()]) ?>"><?= $category->getName() ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Véhicule</th>
                    <th class="table-info">Pourcentage</th>
                    <th>Cote globale</th>
                    <th class="table-light text-primary fw-bold">Gain potentiel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entryList as $entry) : ?>
                    <tr>
                        <td><?= $entry['driver']->getNumber() ?></td>
                        <td><?= $entry['driver']->getFirstName() ?></td>
                        <td><?= $entry['driver']->getLastName() ?></td>
                        <td><?= $entry['driver']->getVehicle() ?></td>
                        <td class="table-info fst-italic"><?= $entry['votes'] ?> %</td>
                        <td><?= $entry['driver']->getOverall()  ?></td>
                        <td class="table-light text-primary fw-bold"><?= $entry['driver']->getOverall() * 10 ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('driver-home') ?>">Retour</a>

</div>

<div class="admin__container">
    
    <div>
        <h2 class="admin__container__title">Liste des engagés</h2>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Année</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($years as $year) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-list', ['year' => $year->getId(), 'id' => 1]) ?>"><?= $year->getId() ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($races as $race) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-list', ['year' => $currentYear, 'id' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
    </div>

    <div>
        <h2 class="questionnaire__title">
            <?php if (!isset($races[$raceId])) : ?>
                Aucune liste générée
            <?php else : ?>
            Liste des engagés pour <?= $races[$raceId]->getName() ?> - <?= $currentYear ?>
        <?php endif; ?></h2>
        <?php if (isset($races[$raceId])) : ?>
        <div class="dropdown">
            <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Supprimer
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Non</a></li>
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-deletelist', ['year' => $currentYear, 'id' => $raceId]) ?>">Confirmer la suppression</a></li>
            </ul>
        </div>
        <?php endif; ?>
    </div>

    <div>
        <table class="table table-light table-stripped table-striped-columns table-hover">
            <thead>
                <th>Catégorie</th>
                <th>Numéro</th>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Supprimer</th>
            </thead>

            <tbody>
            <?php foreach ($entrylist as $entry) : ?>
                <tr>
                    <td><?= $category[$entry->getCategoryId()]->getName() ?></td>
                    <td><?= $driver[$entry->getDriverId()]->getNumber() ?></td>
                    <td><?= $driver[$entry->getDriverId()]->getFirstName() ?></td>
                    <td><?= $driver[$entry->getDriverId()]->getLastName() ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Supprimer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Non</a></li>
                                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-deleteentry', ['id' => $entry->getId()]) ?>">Confirmer la suppression</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach ; ?>
            </tbody>
        </table>
    </div>


    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('entrylist-home') ?>">Retour</a>
    </div>


</div>

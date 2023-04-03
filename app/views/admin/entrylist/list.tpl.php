<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">
    

        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des engagés</h2>

        <div class="btn-group col-6 mt-2" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Année</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($years as $year) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-list', ['year' => $year->getId(), 'id' => 1]) ?>"><?= $year->getId() ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>


    <div class="btn-group col-7 mt-2" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($races as $race) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-list', ['year' => $currentYear, 'id' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
    </div>


        <h2 class="bg-info rounded-4 shadow fw-bold col-8 p-2 mt-2">
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
                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-deletelist', ['id' => $raceId, 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
            </ul>
        </div>
        <?php endif; ?>


    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
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
                    <td><?= $entry->getNumber() ?></td>
                    <td><?= $entry->getFirstName() ?></td>
                    <td><?= $entry->getLastName() ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Supprimer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Non</a></li>
                                <li><a class="dropdown-item" href="<?= $this->router->generate('entrylist-deleteentry', ['year' => $currentYear, 'raceId' => $raceId, 'id' => $entry->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach ; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('entrylist-home') ?>">Retour</a>

</div>

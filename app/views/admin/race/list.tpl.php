<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des courses - <?= $currentYear ?></h2>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Année</button>
        <ul class="dropdown-menu">
        <?php foreach ($years as $year) : ?>
            <li><a class="dropdown-item" href="<?= $year->getId() ?>"><?= $year->getId() ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
            <thead>
                <th>#</th>
                <th>Epreuve</th>
                <th>Deadline</th>
                <!-- <th>Poster</th> -->
                <th>Editer</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
                <?php foreach ($races as $race) : ?>
                    <tr>
                        <td><?= $race->getId() ?></td>
                        <td><?= $race->getName() ?></td>
                        <td><?= $race->getDate() ?></td>
                        <!-- <td><img src="<?= $baseURI . $race->getPoster() ?>" alt="" class="picture-driver"></td> -->
                        <td>
                            <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('race-edit', ['id' => $race->getId()]) ?>">Modifier</a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Supprimer</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Non</a></li>
                                    <li><a class="dropdown-item" href="<?= $this->router->generate('race-delete', ['id' => $race->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('race-home') ?>">Retour</a>

</div>
<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">

    <div class="btn-group col-7 mt-2" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($races as $race) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-participations', ['id' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
    </div>
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-10 col-sm-8 p-2 mt-3">Liste des participations pour <?= $currentRace->getName() ?></h2>

    <p class="col-6 bg-light rounded-4 m-2 p-2 shadow">Nombre de participations : <span class="btn btn-outline-danger shadow fw-bold fst-italic"><?= $total ?></span></p>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($participations as $participation) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $players[$participation->getPlayerId()]->getPseudo() ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('adminuser-home') ?>">Retour</a>

</div>

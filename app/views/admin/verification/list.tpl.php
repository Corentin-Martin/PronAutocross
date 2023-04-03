<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des vérifications - <?= $currentYear ?></h2>

    <div class="btn-group" role="group">
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
                <th>Epreuve</th>
                <?php foreach ($categories as $category) : ?>
                <th><?= $category->getName() ?></th>
                <?php endforeach; ?>
                <th>Bonus 1</th>
                <th>Bonus 2</th>
                <th>Editer</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
                <?php foreach ($verifications as $verification) : ?>
                    <tr>
                        <td><?= $races[$verification->getRaceId()]->getName() ?></td>
                        <td><?= $driversById[$verification->getMaxiSprint()]->getFirstName() . ' ' . $driversById[$verification->getMaxiSprint()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getTourismeCup()]->getFirstName() . ' ' . $driversById[$verification->getTourismeCup()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getSprintGirls()]->getFirstName() . ' ' . $driversById[$verification->getSprintGirls()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getBuggyCup()]->getFirstName() . ' ' . $driversById[$verification->getBuggyCup()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getJuniorSprint()]->getFirstName() . ' ' . $driversById[$verification->getJuniorSprint()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getMaxiTourisme()]->getFirstName() . ' ' . $driversById[$verification->getMaxiTourisme()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getBuggy1600()]->getFirstName() . ' ' . $driversById[$verification->getBuggy1600()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getSuperSprint()]->getFirstName() . ' ' . $driversById[$verification->getSuperSprint()]->getLastName() ?></td>
                        <td><?= $driversById[$verification->getSuperBuggy()]->getFirstName() . ' ' . $driversById[$verification->getSuperBuggy()]->getLastName() ?></td>
                        <td><?= $verification->getBonus1()?></td>
                        <td><?= $verification->getBonus2() ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('verification-edit', ['raceId' => $verification->getRaceId(), 'id' => $verification->getId()]) ?>">Modifier</a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Supprimer
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Non</a></li>
                                    <li><a class="dropdown-item" href="<?= $this->router->generate('verification-delete', ['id' => $verification->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('verification-home') ?>">RETOUR</a>

</div>
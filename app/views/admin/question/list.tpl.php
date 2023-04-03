<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des questions - <?= $currentYear ?></h2>

    <div class="btn-group col-5 mt-2" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Année</button>
        <ul class="dropdown-menu">
        <?php foreach ($years as $year) : ?>
            <li ><a class="dropdown-item" href="<?= $year->getId() ?>"><?= $year->getId() ?></a></li>
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
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td><?= $races[$question->getRaceId()]->getName() ?></td>
                    <td><?= $question->getMaxiSprint() ?></td>
                    <td><?= $question->getTourismeCup() ?></td>
                    <td><?= $question->getSprintGirls() ?></td>
                    <td><?= $question->getBuggyCup() ?></td>
                    <td><?= $question->getJuniorSprint() ?></td>
                    <td><?= $question->getMaxiTourisme() ?></td>
                    <td><?= $question->getBuggy1600() ?></td>
                    <td><?= $question->getSuperSprint() ?></td>
                    <td><?= $question->getSuperBuggy() ?></td>
                    <td><?= $question->getBonus1() ?></td>
                    <td><?= $question->getBonus2() ?></td>
                    <td>
                        <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('question-edit', ['year' => $currentYear,'id' => $question->getId()]) ?>">Modifier</a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Supprimer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Non</a></li>
                                <li><a class="dropdown-item" href="<?= $this->router->generate('question-delete', ['id' => $question->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('question-home') ?>">Retour</a>

</div>
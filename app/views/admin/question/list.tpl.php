<div class="admin__container">
    
    <div>
        <h2 class="admin__container__title">Liste des questions - <?= $currentYear ?></h2>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Année</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($years as $year) : ?>
                <li><a class="dropdown-item" href="<?= $year->getId() ?>"><?= $year->getId() ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

    

    <div>

        <table class="table table-light table-stripped table-striped-columns table-hover">
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
                        <a type="button" class="btn btn-outline-warning" href="<?= $router->generate('question-edit', ['year' => $currentYear,'id' => $question->getId()]) ?>">Modifier</a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Supprimer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Non</a></li>
                                <li><a class="dropdown-item" href="<?= $router->generate('question-delete', ['id' => $question->getId()]) ?>">Confirmer la suppression</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
     </table>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
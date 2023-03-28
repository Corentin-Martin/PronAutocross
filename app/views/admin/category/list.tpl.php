<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="admin__container">
    

    <h2 class="admin__container__title">CATEGORIES</h2>

    <div>
        <table class="table table-light table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la catégorie</th>
                    <th>Ordre de passage</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            
            <tbody>

                <?php foreach ($categories as $category) : ?>

                <tr>
                    <td><?= $category->getId() ?></td>
                    <td><?= $category->getName() ?></td>
                    <td><?= $category->getRunningOrder() ?></td>
                    <td>
                        <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('category-edit', ['id' => $category->getId()]) ?>">Modifier</a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Supprimer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Non</a></li>
                                <li><a class="dropdown-item" href="<?= $this->router->generate('category-delete', ['id' => $category->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    
    <div>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $this->router->generate('category-add')?>">AJOUTER UNE CATEGORIE</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
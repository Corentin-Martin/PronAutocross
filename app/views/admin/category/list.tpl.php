<div class="row mt-3 justify-content-center">

    <?php $token = $_SESSION['token'] = random_bytes(5); ?>
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">CATEGORIES</h2>

    <?php if (!empty($errorList)) : ?>
        <div class="alert alert-danger col-8 m-auto" role="alert">
            <ul>
                <?php foreach($errorList as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
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
                                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Supprimer</button>
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
    
    <a type="button" class="btn btn-dark btn-lg mt-3 col-6" href="<?= $this->router->generate('category-add')?>">AJOUTER UNE CATEGORIE</a>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>

</div>
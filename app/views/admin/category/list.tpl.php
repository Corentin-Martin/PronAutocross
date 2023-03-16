
<div class="admin__container">
    

    <h2 class="admin__container__title">CATEGORIES</h2>

    <div>
        <table class="table table-light table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la catégorie</th>
                    <th>Ordre de passage</th>
                </tr>
            </thead>
            
            <tbody>

                <?php foreach ($categories as $category) : ?>

                <tr>
                    <td><?= $category->getId() ?></td>
                    <td><?= $category->getName() ?></td>
                    <td><?= $category->getRunningOrder() ?></td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    
    <div>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('category-add')?>">AJOUTER UNE CATEGORIE</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
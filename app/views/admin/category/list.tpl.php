<h2>Catégories</h2>
<div>
<a href="<?= $router->generate('category-add')?>">CREER UNE CATEGORIE</a>
<table>
    <thead>
        <tr>
            <th>Id</th>
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

<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
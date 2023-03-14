HOME CATEGORY
<div>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom de la catégorie</th>
        </tr>
    </thead>
    
    <tbody>

    <?php foreach ($categories as $category) : ?>

    <tr>
        <td><?= $category->getId() ?></td>
        <td><?= $category->getName() ?></td>
    </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<a href="<?= $router->generate('category-add')?>">CREER UNE CATEGORIE</a>
</div>
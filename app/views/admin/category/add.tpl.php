ADD CATEGORY

<form action="" method="post">
    <label for="name">Nom de la catégorie<input type="text" name="name" id="name" placeholder="Nom de la catégorie"></label>
    <label for="running_order">Ordre de passage<input type="number" name="running_order" id="running_order" min="0" max="20" step="1" value="0"></label>
    <button type="submit">CREER NOUVELLE CATEGORIE</button>
</form>

<button><a href="<?= $router->generate('category-list') ?>">RETOUR</a></button>
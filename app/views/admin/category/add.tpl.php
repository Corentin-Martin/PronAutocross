ADD CATEGORY

<form action="" method="post">
    <label for="name">Nom de la catégorie<input type="text" name="name" id="name" placeholder="Nom de la catégorie"></label>
    <button type="submit">CREER NOUVELLE CATEGORIE</button>
</form>

<button><a href="<?= $router->generate('category-list') ?>">RETOUR</a></button>
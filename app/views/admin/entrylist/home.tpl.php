<h2>GESTION DE LISTE DES ENGAGES</h2>

<a href="<?= $router->generate('entrylist-add') ?>">CREER UNE LISTE DES ENGAGES</a>
<a href="<?= $router->generate('entrylist-list', ['year' => 2023, 'id' => 1]) ?>">PARCOURIR UNE LISTE DES ENGAGES</a>

<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
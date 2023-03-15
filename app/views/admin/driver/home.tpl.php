<h2>ESPACE GESTION DES PILOTES</h2>

<nav>
    <ul>
        <li><a href="<?= $router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">TOUS LES PILOTES</a></li>
        <li><a href="<?= $router->generate('driver-add') ?>">AJOUTER UN PILOTE</a></li>
    </ul>
</nav>

<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
HOME DES DRIVERS

<nav>
    <ul>
        <li><a href="<?= $router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">TOUS LES PILOTES</a></li>
        <li><a href="<?= $router->generate('driver-add') ?>">AJOUTER UN PILOTE</a></li>
    </ul>
</nav>
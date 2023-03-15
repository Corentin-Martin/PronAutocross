<h2>COURSES</h2>

<ul>
    <li><a href="<?= $router->generate('race-add') ?>">Créer une nouvelle épreuve</a>
</li>
    <li><a href="<?= $router->generate('race-list', ['year' => 2023]) ?>">Parcourir les courses</a></li>
</ul>


<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
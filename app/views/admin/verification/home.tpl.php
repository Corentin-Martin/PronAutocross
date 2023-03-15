<h2>VERIFICATION</h2>

<ul>
    <li><a href="<?= $router->generate('verification-add', ['year' => 2023, 'raceId' => 1]) ?>">Générer une vérification</a>
</li>
    <li><a href="<?= $router->generate('verification-list', ['year' => 2023]) ?>">Parcourir les vérifications</a></li>
</ul>


<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
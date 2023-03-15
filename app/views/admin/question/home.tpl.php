<h2>QUESTIONS</h2>

<ul>
    <li><a href="<?= $router->generate('question-add') ?>">Générer une liste des questions</a>
</li>
    <li><a href="<?= $router->generate('question-list', ['year' => 2023]) ?>">Parcourir les questionnaires</a></li>
</ul>


<button><a href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a></button>
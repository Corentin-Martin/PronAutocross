<div class="admin__container">
    

    <h2 class="admin__container__title">QUESTIONS</h2>

    
    <div>
        <a type="button" class="btn btn-secondary btn-lg" href="<?= $router->generate('question-add', ['year' => 2023]) ?>">GENERER UNE LISTE DE QUESTIONS</a>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('question-list', ['year' => 2023]) ?>">PARCOURIR LES QUESTIONNAIRES</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
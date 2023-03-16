
<div class="admin__container">
    

    <h2 class="admin__container__title">COURSES</h2>

    
    <div>
        <a type="button" class="btn btn-secondary btn-lg" href="<?= $router->generate('race-add') ?>">CREER UNE NOUVELLE EPREUVE</a>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('race-list', ['year' => 2023]) ?>">PARCOURIR LES EPREUVES</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
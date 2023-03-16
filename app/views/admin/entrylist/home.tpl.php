
<div class="admin__container">
    

    <h2 class="admin__container__title">LISTE DES ENGAGES</h2>

    
    <div>
        <a type="button" class="btn btn-secondary btn-lg" href="<?= $router->generate('entrylist-add') ?>">CREER UNE LISTE DES ENGAGES</a>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('entrylist-list', ['year' => 2023, 'id' => 1]) ?>">PARCOURIR UNE LISTE DES ENGAGES</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
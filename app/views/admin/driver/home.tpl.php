
<div class="admin__container">
    

    <h2 class="admin__container__title">GESTION DES PILOTES</h2>

    
    <div>
        <a type="button" class="btn btn-secondary btn-lg" href="<?= $router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">TOUS LES PILOTES</a>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('driver-add') ?>">AJOUTER UN PILOTE</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
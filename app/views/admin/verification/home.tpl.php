
<div class="admin__container">
    

    <h2 class="admin__container__title">VERIFICATIONS</h2>

    
    <div>
        <a type="button" class="btn btn-secondary btn-lg" href="<?= $router->generate('verification-add', ['year' => 2023, 'raceId' => 1]) ?>">GENERER UNE VERIFICATION</a>
        <a type="button" class="btn btn-dark btn-lg" href="<?= $router->generate('verification-list', ['year' => 2023]) ?>">PARCOURIR LES VERIFICATIONS</a>
    </div>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
    </div>


</div>
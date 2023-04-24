<div class="row mt-3 m-auto justify-content-center">
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">GESTION DES PILOTES</h2>

    <div class="mt-3">
        <a type="button" class="btn btn-secondary btn-lg m-1" href="<?= $this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">TOUS LES PILOTES</a>
        <a type="button" class="btn btn-dark btn-lg m-1" href="<?= $this->router->generate('driver-add') ?>">AJOUTER UN PILOTE</a>
        <a type="button" class="btn btn-info btn-lg m-1" href="<?= $this->router->generate('driver-editPlaces') ?>">EDITER LES CLASSEMENTS</a>
        <a type="button" class="btn btn-success btn-lg m-1" href="<?= $this->router->generate('driver-editRates', ['id' => 1]) ?>">METTRE A JOUR LES COTES</a>
        <a type="button" class="btn btn-light btn-lg m-1" href="<?= $this->router->generate('driver-showVotes', ['categoryId' => 1, 'raceId' => 1]) ?>">VISUALISER LES VOTES</a>
        <a type="button" class="btn btn-secondary btn-lg m-1" href="<?= $this->router->generate('driver-showByRate', ['categoryId' => 1]) ?>">VISUALISER LES FAVORIS</a>
    </div>

    <a type="button" class="btn btn-warning btn-lg  mt-3 col-8"  href="<?= $this->router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
</div>
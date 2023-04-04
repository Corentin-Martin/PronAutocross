<div class="row mt-3 m-auto justify-content-center">
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">GESTION DES UTILISATEURS</h2>

    <div class="mt-3">
        <a type="button" class="btn btn-secondary btn-lg m-1" href="<?= $this->router->generate('adminuser-list', ['action' => 'id']) ?>">TOUS LES UTILISATEURS</a>
        <a type="button" class="btn btn-info btn-lg m-1" href="<?= $this->router->generate('adminuser-participations', ['id' => 1]) ?>">PARTICIPATIONS</a>
    </div>

    <a type="button" class="btn btn-warning btn-lg  mt-3 col-8"  href="<?= $this->router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>
</div>
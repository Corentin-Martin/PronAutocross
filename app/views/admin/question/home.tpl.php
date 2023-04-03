<div class="row mt-3 m-auto justify-content-center">
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">QUESTIONS</h2>

    <div class="mt-3">
        <a type="button" class="btn btn-secondary btn-lg m-1" href="<?= $this->router->generate('question-add', ['year' => 2023]) ?>">GENERER UNE LISTE DE QUESTIONS</a>
        <a type="button" class="btn btn-dark btn-lg m-1" href="<?= $this->router->generate('question-list', ['year' => 2023]) ?>">PARCOURIR LES QUESTIONNAIRES</a>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('admin') ?>">RETOUR AU TABLEAU DE BORD GENERAL</a>



</div>
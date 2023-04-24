<div class="row mt-3 m-auto justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-4 p-2">QG ADMIN</h2>

    <div class="row m-auto justify-content-center">
        
        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
            <a href="<?= $this->router->generate('question-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Questions</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('question-list', ['year' => 2023]) ?>">Parcourir les questionnaires</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('question-add', ['year' => 2023]) ?>">Générer un questionnaire</a>
                </li>
            </ul>
        </div>

        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
            <a href="<?= $this->router->generate('entrylist-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Liste des engagés</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('entrylist-list', ['year' => 2023, 'id' => 1]) ?>">Parcourir une liste des engagés</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('entrylist-add') ?>">Générer une liste des engagés</a>
                </li>
            </ul>
        </div>
        
        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
            <a href="<?= $this->router->generate('verification-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Vérifications</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                        <a class="btn p-0" href="<?= $this->router->generate('verification-list', ['year' => 2023]) ?>">Parcourir les Vérifications</a>
                </li>
                <li class="list-group-item p-1">
                    <a  class="btn p-0"href="<?= $this->router->generate('verification-add', ['year' => 2023, 'raceId' => 1]) ?>">Créer une vérification</a>
                </li>
            </ul>
        </div>
        
        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
            <a href="<?= $this->router->generate('driver-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Pilotes</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">Parcourir les pilotes</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-add') ?>">Ajouter un pilote</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-editPlaces') ?>">Editer les classements</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-editRates', ['id' => 1]) ?>">Mettre à jour les cotes</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-showVotes', ['categoryId' => 1, 'raceId' => 1]) ?>">Visualiser les votes</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('driver-showByRate', ['categoryId' => 1]) ?>">Visualiser les favoris</a>
                </li>
            </ul>
        </div>
        
        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
            <a href="<?= $this->router->generate('category-list') ?>"><h3 class="col-12 btn btn-primary shadow" >Catégories</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('category-list')?>">Liste des catégories</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0" href="<?= $this->router->generate('category-add')?>">Créer une catégorie</a>
                </li>
            </ul>
        </div>

        <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around"> 
            <a href="<?= $this->router->generate('race-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Courses</h3></a>
            <ul class="list-group text-primary col-12">
                <li class="list-group-item p-1">
                    <a class="btn p-0"href="<?= $this->router->generate('race-list', ['year' => 2023]) ?>">Parcourir les épreuves</a>
                </li>
                <li class="list-group-item p-1">
                    <a class="btn p-0"href="<?= $this->router->generate('race-add') ?>">Créer une épreuve</a>
                </li>
            </ul>
        </div>

        <?php if ($_SESSION['user']->getRole() === 'admin') : ?>
            <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1 d-flex flex-column justify-content-around">
                <a href="<?= $this->router->generate('adminuser-home') ?>"><h3 class="col-12 btn btn-primary shadow" >Gestion des utilisateurs</h3></a>
                <ul class="list-group text-primary col-12">
                    <li class="list-group-item p-1">
                        <a class="btn p-0" href="<?= $this->router->generate('adminuser-list', ['action' => 'id']) ?>">Tous les utilisateurs</a>
                    </li>
                    <li class="list-group-item p-1">
                        <a class="btn p-0" href="<?= $this->router->generate('adminuser-participations', ['id' => 1]) ?>">Participations</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

    </div>

    <a type="button" class="btn btn-warning btn-lg col-6 mt-3"  href="<?= $this->router->generate('home') ?>">RETOUR AU SITE GENERAL</a>
</div>
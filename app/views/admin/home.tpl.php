<div class="row mt-3 m-auto justify-content-center">
<h2 class="bg-danger text-light rounded-4 shadow fw-bold col-4 p-2">QG ADMIN</h2>

<div class="row m-auto justify-content-center">
    
    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow m-1">
        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('question-home') ?>">Questions</a>
            </h3>
        </div>
    
        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('question-list', ['year' => 2023]) ?>">Parcourir les questionnaires</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('question-add', ['year' => 2023]) ?>">Générer un questionnaire</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1">

        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('entrylist-home') ?>">Liste des engagés</a>
            </h3>
        </div>
        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('entrylist-list', ['year' => 2023, 'id' => 1]) ?>">Parcourir une liste des engagés</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('entrylist-add') ?>">Générer une liste des engagés</a>
                </li>
            </ul>
        </div>

    </div>
    
    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1">
        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('verification-home') ?>">Vérifications</a>
            </h3>
        </div>

        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('verification-list', ['year' => 2023]) ?>">Parcourir les Vérifications</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('verification-add', ['year' => 2023, 'raceId' => 1]) ?>">Créer une vérification</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1">

        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('driver-home') ?>">Pilotes</a>
            </h3>
        </div>

        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">Parcourir les pilotes</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('driver-add') ?>">Ajouter un pilote</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('driver-editPlaces') ?>">Editer les classements</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('driver-editRates', ['id' => 1]) ?>">Mettre à jour les cotes</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1">
        
        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('category-list') ?>">Catégories</a>
            </h3>
        </div>
        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('category-list')?>">Liste des catégories</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('category-add')?>">Créer une catégorie</a>
                </li>
            </ul>
        </div>
    </div>




    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1"> 
        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('race-home') ?>">Courses</a>
            </h3>
        </div>

        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('race-list', ['year' => 2023]) ?>">Parcourir les épreuves</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('race-add') ?>">Créer une épreuve</a>
                </li>
            </ul>
        </div>
    </div>

    <?php if ($_SESSION['user']->getRole() === 'admin') : ?>
    <div class="col-5 col-sm-3 bg-secondary p-3 rounded-3 shadow  m-1">
        <div class="admin__home__container__div__title col-12">
            <h3>
                <a href="<?= $this->router->generate('race-home') ?>">Gestion des utilisateurs</a>
            </h3>
        </div>

        <div class="admin__home__container__div__menu col-12">
            <ul>
                <li>
                    <a href="<?= $this->router->generate('race-list', ['year' => 2023]) ?>">TO DO</a>
                </li>
                <li>
                    <a href="<?= $this->router->generate('race-add') ?>">TO DO</a>
                </li>
            </ul>
        </div>
    </div>
    <?php endif; ?>

</div>

<div>
    <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('home') ?>">RETOUR AU SITE GENERAL</a>
</div>
    </div>
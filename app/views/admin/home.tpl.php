<div class="admin__home__container">
    <div class="admin__home__container_div">

        <h3><a href="<?= $router->generate('category-list') ?>">Catégories</a></h3>
        <ul>
            <li><a href="<?= $router->generate('category-list')?>">Liste des catégories</a></li>
            <li><a href="<?= $router->generate('category-add')?>">Créer une catégorie</a></li>
        </ul>
    </div>
    <div class="admin__home__container_div">
        <h3><a href="<?= $router->generate('driver-home') ?>">Pilotes</a></h3>
        <ul>
        <li><a href="<?= $router->generate('driver-list', ['categoryId' => 1, 'action' => 'number']) ?>">Parcourir les pilotes</a></li>
        <li><a href="<?= $router->generate('driver-add') ?>">Ajouter un pilote</a></li>
    </ul>
    </div>
    <div class="admin__home__container_div">
        <h3><a href="<?= $router->generate('entrylist-home') ?>">Liste des engagés</a></h3>
<ul>
    <li><a href="<?= $router->generate('entrylist-list', ['year' => 2023, 'id' => 1]) ?>">Parcourir une liste des engagés</a></li>
    <li><a href="<?= $router->generate('entrylist-add') ?>">Générer une liste des engagés</a></li>
</ul>


    </div>
    <div class="admin__home__container_div">
    <h3><a href="<?= $router->generate('question-home') ?>">Questions</a></h3>
        <ul>
        <li><a href="<?= $router->generate('question-list', ['year' => 2023]) ?>">Parcourir les questionnaires</a></li>
        <li><a href="<?= $router->generate('question-add') ?>">Générer un questionnaire</a></li>
    </ul>
    </div>
    <div class="admin__home__container_div"> 
        <h3><a href="<?= $router->generate('race-home') ?>">Courses</a></h3>
        <ul>
        <li><a href="<?= $router->generate('race-list', ['year' => 2023]) ?>">Parcourir les épreuves</a></li>
        <li><a href="<?= $router->generate('race-add') ?>">Créer une épreuve</a></li>
    </ul>
</div>
    <div class="admin__home__container_div"><h3>Vérification</h3></div>
    <div class="admin__home__container_div"><h3>Gestion des côtes</h3></div>
    <div class="admin__home__container_div"><h3>Retour au site général</h3></div>
</div>
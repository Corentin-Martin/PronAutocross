<div class="admin__container">

<?php if ($category) : ?>
    <h2 class="admin__container__title">Editer la catégorie</h2>
<?php else : ?>
    <h2 class="admin__container__title">Créer une catégorie</h2>
<?php endif; ?>

<?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger col-12 col-sm-8 m-auto" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <div>
    <form action="" method="post">
    <div class="form-group">
        <label for="name">Nom de la catégorie
            <input class="form-control" type="text" name="name" id="name" placeholder="Nom de la catégorie" <?= ($category) ? "value = \" {$category->getName()} \"" : "" ?>>
        </label>
    </div>
    <div class="form-group">
        <label for="running_order">Ordre de passage
            <input class="form-control" type="number" name="running_order" id="running_order" min="0" max="20" step="1" <?= ($category) ? "value = \"{$category->getRunningOrder()}\"" : "value = \"0\"" ?> >
        </label>
    </div>
    
    <div class="form-group">
    <button class="btn btn-success btn-lg" type="submit">
        <?php if ($category) : ?>
            Editer cette catégorie
        <?php else : ?>
            Créer cette nouvelle catégorie
        <?php endif; ?>
    </button>
    </div>

    <?php $token = $_SESSION['token'] = random_bytes(5); ?>
    <input type="hidden" name="token" value="<?= $token ?>">

</form>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('category-list') ?>">RETOUR</a>
    </div>


</div>
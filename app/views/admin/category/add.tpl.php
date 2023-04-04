<div class="row mt-3 justify-content-center">

    <?php if ($category) : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer la catégorie</h2>
    <?php else : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Créer une catégorie</h2>
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

    <div class="col-12">
        <form action="" method="post">
            <div class="form-group">
                <label class="col-8 text-primary fw-bold shadow border border-primary p-2 mt-2" for="name">Nom de la catégorie
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nom de la catégorie" <?= ($category) ? "value = \" {$category->getName()} \"" : "" ?>>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary fw-bold shadow border border-primary p-2 mt-2" for="running_order">Ordre de passage
                    <input class="form-control" type="number" name="running_order" id="running_order" min="0" max="20" step="1" <?= ($category) ? "value = \"{$category->getRunningOrder()}\"" : "value = \"0\"" ?> >
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg mt-3 col-6" type="submit">
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
    
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('category-list') ?>">RETOUR</a>

</div>
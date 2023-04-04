<div class="row mt-3 justify-content-center">

    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer les cotes</h2>

    <div class="btn-group col-6" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            <ul class="dropdown-menu">
                <?php foreach ($races as $race) : ?>
                    <li><a class="dropdown-item" href="<?= $race->getId() ?>"><?= $race->getName() ?></a></li>
                <?php endforeach; ?>
            </ul>
    </div>

    <form action="" method="post">
        <div>
            <button class="btn btn-success btn-lg mt-3 col-6" type="submit"> Mettre à jour les cotes après <?= $currentRace->getName() ?></button>
        </div>
        <?php $token = $_SESSION['token'] = random_bytes(5); ?>
        <input type="hidden" name="token" value="<?= $token ?>">
    </form>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('driver-home') ?>">RETOUR</a>

</div>
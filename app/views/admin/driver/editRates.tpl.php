<div class="admin__container">

    <h2 class="admin__container__title">Editer les cotes</h2>

    <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Epreuve</button>
            
            <ul class="dropdown-menu">
            <?php foreach ($races as $race) : ?>
                <li><a class="dropdown-item" href="<?= $race->getId() ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
            </ul>
    </div>

<form action="" method="post">
    <div>
        <button class="btn btn-success btn-lg" type="submit">
                Editer les cotes
        </button>
    </div>

    <?php $token = $_SESSION['token'] = random_bytes(5); ?>
    <input type="hidden" name="token" value="<?= $token ?>">

</form>

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('driver-home') ?>">RETOUR</a>
    </div>


</div>
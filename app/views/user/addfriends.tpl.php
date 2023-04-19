<h3 class="col-8 col-sm-5 bg-primary mt-3 mx-auto p-2 text-light rounded-4 shadow">Ajouter un ami</h3>

<?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row m-auto justify-content-center mt-3 bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7; max-width: 85%;">

<form class="col-6" action="" method="post">
    <label for="addFriends" class="form-label col-12 fw-bold"> Sélectionnez un joueur à suivre
        <select class="form-select mt-2" name="addFriends" id="addFriends">
                <option value="">-</option>
            <?php foreach ($players as $player) : ?>
                <option value="<?= $player->getId() ?>"><?= $player->getPseudo() ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <button class="btn btn-success col-12 mt-3" type="submit">Suivre les résultats de ce joueur</button>
</form>

</div>
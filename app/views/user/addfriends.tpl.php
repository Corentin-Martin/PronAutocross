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

    <p>Pour suivre les résultats d'un joueur, <span class="fst-italic">tapez son pseudo</span> dans la barre de recherche puis <span class="fw-bold">cochez la case correspondante</span>.</p>
    <p>Vous pouvez sélectionner <span class="text-decoration-underline fst-italic">plusieurs joueurs</span> avant de valider.</p>

    <input type="text" class="col-12 col-sm-7 shadow rounded-4 mb-2" id="searchbar" onkeyup="searchbar()" placeholder="Rechercher un joueur...">

    <div class="col-12 inProgress d-none">
        <p>Vous avez sélectionné :</p>
        <ul class="toAdd"></ul>
    </div>

    <form class="col-12 col-sm-6" action="" method="post">
        <button class="btn btn-success col-12 mt-1 d-none sendFriends" type="submit">Suivre ce(s) joueur(s)</button>

        <div class="border col-12 d-flex flex-column align-items-center" id="playersList">
            <?php foreach ($players as $player) : ?>
                <div class="col-6 col-sm-4 text-start">
                    <label class="form-check-label mt-1 mb-1 fw-bold fst-italic" for="<?= $player->getId() ?>">
                        <input type="checkbox" class="form-check-input me-1" name="<?= $player->getId() ?>" id="<?= $player->getId() ?>" value="<?= $player->getId() ?>"><?= $player->getPseudo() ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

    </form>

</div>

<script src="<?= $baseURI ?>assets/js/friends.js"></script>
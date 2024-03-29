<h1 class="btn btn-outline-primary mt-3">Vous jouez pour <?= $race->getName() .  ' - ' . $race->getYearId() ?></h1>

<?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<p class="row bg-success rounded-3 p-2 m-3 justify-content-center text-light shadow">Sélectionnez un pilote par catégorie en cliquant dessus et validez en cliquant sur le bouton "Catégorie suivante" qui apparaitra au dessus et en dessous de chaque liste des engagés puis répondez aux deux questions bonus et envoyez votre participation !</p>

<form action="" method="post" class="row d-flex flex-column align-items-center playform">

    <?php foreach ($categories as $category) : $categoryToGet = str_replace(" ", "", $category->getName()); ?>
    <div class="row justify-content-center <?=$categoryToGet?>">
        <div class="col-8 btn btn-warning next d-none">Catégorie suivante</div>
        <h3 class="badge bg-dark fs-1 col-6 mt-3"><?= $category->getName() ?></h3>
        <h4 class="bg-light col-10 my-2 rounded-4"><?= $questions->{'get'.$categoryToGet}() ?></h4>
        <div class = "row justify-content-center bg-light" style="--bs-bg-opacity: .5;">

            <?php foreach ($entrylist[$category->getId()] as $entry) : ?>

                <label class="border-dark m-2 col-3 col-sm-4 col-md-2 bg-info rounded-4 shadow p-2" for="<?= $entry->getId() ?>">
                <input type="radio" class="radio" name="<?= $categoryToGet ?>" value="<?= $entry->getId() ?>" id="<?= $entry->getId() ?>" required>
                <div class="driver">
                    <div class="badge bg-light mb-1"><?= $category->getName() ?></div>
                    <div class="card-body">
                        <p class="bg-primary fst-italic rounded text-light fs-6">
                            <?= $entry->getFirstName() ?> <strong><?= $entry->getLastName() ?></strong>
                        </p>
                        <p class="fst-italic">#<?= $entry->getNumber() ?> - <strong><?= $entry->getVehicle() ?></strong></p>
                        <div class="row d-flex flex-column align-items-center">
                            <p class="btn btn-warning col-6"><?= $entry->getOverall() ?></p>
                            <div class="col-10 mx-1">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="<?= $entry->getOverall() ?>" aria-valuemin="1.01" aria-valuemax="14.5" style="width: <?= 106.9 - (100 * $entry->getOverall() / 14.5)?>%;"></div>
                                </div>
                            </div>
                            <p> Gain potentiel : <?= $entry->getOverall() * 10 ?></p>
                        </div>
                    </div>
                </div>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="col-6 btn btn-warning next d-none">Catégorie suivante</div>
    </div>
    <?php endforeach; ?>

    <div class="endbloc justify-content-center">
        <div class="row justify-content-center">
            <h3 class="badge bg-dark fs-1 col-6 mt-3">Bonus 1</h3>
            <h4 class="bg-light col-10 my-2 rounded-4"><?= $questions->getBonus1() ?></h4>
            <div class = "row justify-content-center bg-light" style="--bs-bg-opacity: .5;">
                <div class="col-6">
                    <select class="form-select col-8" name="bonus1" id="bonus1" required>
                        <option class="text-center"> - </option>
                        <option class="text-center" value ="oui"> Oui </option>
                        <option class="text-center" value ="non"> Non </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <h3 class="badge bg-dark fs-1 col-6 mt-3">Bonus 2</h3>
            <h4 class="bg-light col-10 my-2 rounded-4"><?= $questions->getBonus2() ?></h4>
            <div class = "row justify-content-center bg-light" style="--bs-bg-opacity: .5;">
                <div class="col-6">
                    <select class="form-select" name="bonus2" id="bonus2" required>
                        <option class="text-center"> - </option>
                        <option class="text-center" value ="oui"> Oui </option>
                        <option class="text-center" value ="non"> Non </option>
                    </select>
                </div>
            </div>
        </div>

        <!-- <div class="row justify-content-center">
            <h3 class="badge bg-dark fs-1 col-6 mt-3">Booster</h3>
            <h4 class="bg-light col-10 my-2 rounded-4">Quelle cote souhaitez-vous booster ?</h4>
            <div class = "row justify-content-center bg-light" style="--bs-bg-opacity: .5;">
                <div class="col-6 booster">
                </div>
            </div>
        </div> -->

        <input type="hidden" name="raceId" id="raceId" value="<?= $race->getId() ?>">
        <input type="hidden" name="year" id="year" value="<?= date('Y') ?>">
        <input type="hidden" name="playerId" id="playerId" value="<?= $_SESSION['user']->getId() ?>">
        <?php $token = $_SESSION['token'] = random_bytes(5); ?>
        <input type="hidden" name="token" value="<?= $token ?>">

        <button class="btn btn-success col-6 mt-3" type="submit">Envoyer votre participation</button>
    </div>
</form>

<script src="<?= $baseURI ?>assets/js/play.js"></script>


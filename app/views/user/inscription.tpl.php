<?php if (!$player) : ?>
    <p class="mt-4 text-center bg-info rounded-4 shadow p-2">Bienvenue dans cette nouvelle aventure <strong>Pron'Autocross</strong>, créez votre compte maintenant et pariez tout au long de la saison sur les résultats des <strong>Championnats et Coupes de France d'Autocross et de Sprint Car</strong> !</p>
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

<div class="row m-auto justify-content-center mt-4">
    <div class="col-8 col-sm-4">
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleInputPseudo" class="form-label fw-bold">Pseudo*</label>
                <input type="text" class="form-control text-center" id="exampleInputPseudo" name="pseudo" placeholder="Votre pseudo" <?= $player ? "value = \" {$player->getPseudo()} \"" : "" ?> required>
            </div>

            <div class="mb-3">
                <label for="exampleInputFirstName" class="form-label fw-bold">Prénom*</label>
                <input type="text" class="form-control text-center" id="exampleInputFirstName" name="firstName" placeholder="Votre prénom" <?= $player ? "value = \" {$player->getFirstName()} \"" : "" ?> required>
            </div>

            <div class="mb-3">
                <label for="exampleInputLastName" class="form-label fw-bold">Nom de famille*</label>
                <input type="text" class="form-control text-center" id="exampleInputLastName" name="lastName" placeholder="Votre nom de famille" <?= $player ? "value = \" {$player->getLastName()} \"" : "" ?> required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">Adresse mail*</label>
                <input type="email" class="form-control text-center" id="exampleInputEmail1" name="email" placeholder="Votre adresse mail" <?= $player ? "value = \" {$player->getMail()} \"" : "" ?>  required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label fw-bold">Mot de passe*</label>
                <input type="password" class="form-control text-center" id="exampleInputPassword1" name="password" placeholder="Votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label fw-bold">Confirmez votre mot de passe*</label>
                <input type="password" class="form-control text-center" id="exampleInputPassword2" name="passwordConfirm" placeholder="Confirmez votre mot de pass" required>
            </div>

            <input type="hidden" name="role" value="member">
            <?php if ($player) : $token = $_SESSION['token'] = random_bytes(5);  ?>
                <input type="hidden" name="token" value="<?= $token ?>">
            <?php endif; ?>
            <p class="fst-italic">*Champs obligatoires</p>
            <button type="submit" class="btn btn-primary">
                <?php if ($player) : ?>
                Modifier mes informations
                <?php else : ?>
                    S'inscrire
                <?php endif; ?>
            </button>
        </form>
    </div>
</div>

<?php if (!empty($errorList)) : ?>

    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach($errorList as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="exampleInputPseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="exampleInputPseudo" name="pseudo" placeholder="Votre pseudo" <?= $player ? "value = \" {$player->getPseudo()} \"" : "" ?> required>
    </div>

    <div class="mb-3">
        <label for="exampleInputFirstName" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="exampleInputFirstName" name="firstName" placeholder="Votre prénom" <?= $player ? "value = \" {$player->getFirstName()} \"" : "" ?> required>
    </div>

    <div class="mb-3">
        <label for="exampleInputLastName" class="form-label">Nom de famille</label>
        <input type="text" class="form-control" id="exampleInputLastName" name="lastName" placeholder="Votre nom de famille" <?= $player ? "value = \" {$player->getLastName()} \"" : "" ?> required>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Votre adresse mail" <?= $player ? "value = \" {$player->getMail()} \"" : "" ?>  required>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Votre mot de passe" required>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirmez votre mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword2" name="passwordConfirm" placeholder="Confirmez votre mot de pass" required>
    </div>

    <input type="hidden" name="role" value="member">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
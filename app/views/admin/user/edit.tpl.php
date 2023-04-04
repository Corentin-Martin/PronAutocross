<div class="row mt-3 justify-content-center">


    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer l'utilisateur</h2>


    <?php if (!empty($errorList)) : ?>
        <div class="alert alert-danger col-8 m-auto" role="alert">
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
                <label class="col-8 text-primary bg-light fw-bold shadow border border-primary p-2 mt-2" for="pseudo"> Pseudo
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value = "<?= $player->getPseudo() ?>" required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary bg-light fw-bold shadow border border-primary p-2 mt-2" for="firstName"> Prénom
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Prénom" value = "<?= $player->getFirstName() ?>"required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary bg-light fw-bold shadow border border-primary p-2 mt-2" for="lastName"> Nom de famille
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Nom de famille" value = "<?= $player->getLastName() ?>" required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary bg-light fw-bold shadow border border-primary p-2 mt-2" for="mail"> Adresse mail
                    <input type="text" class="form-control" name="mail" id="mail" placeholder="Adresse mail" value = "<?= $player->getMail() ?>" required>
                </label>
            </div>
            <div class="form-group">
                <label class="col-8 text-primary bg-light fw-bold shadow border border-primary p-2 mt-2" for="role"> Role
                    <select class="form-control" name="role" id="role" required>
                        <option value="member" <?= ($player->getRole() == 'member') ? 'selected' : '' ?>>Membre</option>
                        <option value="editor" <?= ($player->getRole() == 'editor') ? 'selected' : '' ?>>Editeur</option>
                        <option value="admin" <?= ($player->getRole() == 'admin') ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg mt-3 col-6" type="submit"> Editer cet utilisateur</button>
            </div>

            <?php $token = $_SESSION['token'] = random_bytes(5); ?>
            <input type="hidden" name="token" value="<?= $token ?>">

        </form>
    </div>
    
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('adminuser-home') ?>">RETOUR</a>

</div>
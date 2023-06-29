<?php if ($player) : ?><p class="mt-4 text-center bg-info rounded-4 shadow p-2">Réinitialisation du mot de passe de <span class="fw-bold fst-italic"><?= $player->getPseudo() ?></span> :</p><?php endif; ?>

<?php if (!empty($errorList)) : ?>
  <div class="alert alert-danger col-12 col-sm-8 m-auto" role="alert">
      <ul>
          <?php foreach($errorList as $error) : ?>
              <li><?= $error ?></li>
          <?php endforeach; ?>
      </ul>
  </div>
<?php endif; ?>

<?php if (!empty($okList)) : ?>
  <div class="alert alert-success col-12 col-sm-8 m-auto" role="alert">
      <ul>
          <?php foreach($okList as $ok) : ?>
              <li><?= $ok ?></li>
          <?php endforeach; ?>
      </ul>
  </div>
<?php endif; ?>

<?php if ($player && $tokenValid) : ?>
<div class="row m-auto d-flex flex-column align-items-center">

    <div id="login-column" class="col-md-6">
      <div class="box">
        <div class="float">
          <form class="form" action="" method="post">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label fw-bold">Nouveau mot de passe</label>
                <input type="password" class="form-control text-center" id="exampleInputPassword1" name="password" placeholder="Votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label fw-bold">Confirmez votre mot de passe</label>
                <input type="password" class="form-control text-center" id="exampleInputPassword2" name="passwordConfirm" placeholder="Confirmez votre mot de pass" required>
            </div>
            <div class="form-group mb-3">
              <input type="submit" class="btn btn-info btn-md" value="Envoyer la demande">
            </div>
          </form>
        </div>
      </div>
    </div>
<?php endif; ?>

</div>
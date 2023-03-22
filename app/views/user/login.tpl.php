<p class="mt-4 text-center bg-info rounded-4 shadow p-2">Bienvenue, connectez-vous maintenant à votre espace personnel <strong>Pron'Autocross</strong> :</p>

<?php if (!empty($errorList)) : ?>
  <div class="alert alert-danger col-12 col-sm-8 m-auto" role="alert">
      <ul>
          <?php foreach($errorList as $error) : ?>
              <li><?= $error ?></li>
          <?php endforeach; ?>
      </ul>
  </div>
<?php endif; ?>

<div class="row m-auto d-flex flex-column align-items-center">

    <div id="login-column" class="col-md-6">
      <div class="box">
        <div class="float">
          <form class="form" action="" method="post">
            <div class="form-group mb-3">
              <label class="form-label fw-bold" for="email">
                E-mail:
              </label>
              <br>
              <input type="text" name="email" id="email" class="form-control text-center" placeholder="Votre adresse mail" required>
            </div>
            <div class="form-group mb-3">
              <label class="form-label fw-bold" for="password">
                Mot de passe :
              </label>
              <br>
              <input type="password" name="password" id="password" class="form-control text-center" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-group mb-3">
              <input type="submit" class="btn btn-info btn-md" value="Connexion">
            </div>
          </form>
        </div>
      </div>
    </div>

</div>
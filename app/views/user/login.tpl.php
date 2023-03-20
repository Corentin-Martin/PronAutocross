<?php if (!empty($errorList)) : ?>

<div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach($errorList as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>

<div class="container my-4">
  <div class="row justify-content-center align-items-center">
    <div id="login-column" class="col-md-6">
      <div class="box">
        <div class="float">
          <form class="form" action="" method="post">
            <div class="form-group mb-3">
              <label for="email">
                E-mail:
              </label>
              <br>
              <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label for="password">
                Mot de passe :
              </label>
              <br>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <input type="submit" class="btn btn-info btn-md" value="Connexion">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
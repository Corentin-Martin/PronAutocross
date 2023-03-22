<div class="row mt-2 justify-content-center">
    <h3>Erreur 403, accès interdit</h3>
    <p>Vous n'avez pas les droits pour accéder à cette page.</p>
    <a href="<?= $this->router->generate('home') ?>" class="btn btn-warning col-10">Retourner sur la page d'accueil</a>
    <img src="<?= $baseURI ?>assets/images/red-flag.jpg" alt="" class="img-fluid mt-1">
</div>
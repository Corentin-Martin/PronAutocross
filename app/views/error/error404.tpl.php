<div class="row mt-2 justify-content-center">
    <h3>Erreur 404, la page n'existe pas</h3>
    <p>Ouuuuuups, cela ressemble à une sortie de piste...</p>
    <a href="<?= $this->router->generate('home') ?>" class="btn btn-warning col-10">Retourner sur la page d'accueil</a>
    <img src="<?= $baseURI ?>assets/images/red-flag.jpg" alt="" class="img-fluid mt-1">
</div>
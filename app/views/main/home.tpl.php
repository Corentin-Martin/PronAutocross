<?php if ($gameInProgress) : ?>
    <a class="col-10 col-sm-6 mt-3 m-auto btn btn-danger shadow" href="<?= $this->router->generate('user-add', ['id' => $raceInProgress->getId()]) ?>">LES PARTICIPATIONS POUR <?= $raceInProgress->getName() ?> SONT OUVERTES ! CLIQUEZ ICI POUR PARTICIPER ! </a>
<?php endif; ?>

<div class="row mt-3 m-auto align-items-center">
        <div class="col-12 col-sm-8">
            <article class="bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
                <h2 class="fw-bold fst-italic fs-1">Bienvenue !</h2>
                <p>Cette saison, <strong>Pron'Autocross</strong> fait sa révolution !</p>
                <p>Après 2 premières années concluantes où les participations ont été au rendez-vous, il était temps de <span class="fst-italic text-decoration-underline">passer à la vitesse supérieure</span> !</p>
                <h3 class="text-primary fw-bold">La stratégie arrive </h3>
                <p>Parier sur les courses, c'était bien, amusant, mais à mesure que la saison avançait, l'enjeu disparaissait légèrement et surtout, cela manquait cruellement d'une <span class="fst-italic">bonne dose de stratégie</span> !</p>
                <p>Désormais, il faudra choisir : assurer en misant à tout prix sur le favori ou tenter de parier sur <span class="badge bg-dark fw-bold fs-6">"une grosse cote"</span> !</p>
                <p>Oui oui, cette saison, les <span class="fw-bold text-decoration-underline">cotes</span> font leur apparition dans <strong>Pron'Autocross</strong> ! Elles seront calculées suivant les votes reçus par les pilotes sur les deux épreuves précédentes ainsi que sur leur classement au championnat!</p>
                <h3 class="text-primary fw-bold">On assure tranquille jusqu'à la ligne d'arrivée ou grosse attaque et prise de risques ?</h3>
                <p>Allez-vous simplement voter pour les <span class="fst-italic">favoris aux petites cotes</span> et espérer remporter une centaine de points ? Ou allez-vous être joueur en misant sur des <span class="fst-italic">surprises</span> qui pourront faire grimper votre score jusqu'à plus de 1800 points (ou au contraire le laisseront stagner vers 0...) ? Et si la solution idéale était de savoir créer <span class="fw-bold">un savant dosage entre les deux</span> ?</p>
                <p>Et oui, plus que jamais, il faudra sentir les coups, réfléchir et ... <span class="fw-bold text-decoration-underline">faire les bons choix</span> !</p>
            </article>

            <article class="bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
                <h2 class="fw-bold fst-italic fs-1">Les autres changements majeurs</h2>
                <p>Mis à part les cotes, tout le reste de l'expérience va changer et <span class="text-decoration-underline">être simplifiée</span> !</p>
                <h3 class="text-primary fw-bold">Un compte unique pour chaque joueur</h3>
                <p><strong>Une inscription</strong> à faire et c'est parti pour cette nouvelle aventure ! Plus de risque de pseudo en double et plus de risque non plus de se tromper dans l'écriture de son pseudo et d'apparaitre à deux endroits dans le classement.</p>
                <h3 class="text-primary fw-bold">Le tableau de bord : toute votre saison réunie au même endroit</h3>
                <p>Chaque joueur aura son <strong>espace personnel</strong> où toutes les infos relatives à sa saison seront réunies : <span class="fst-italic">son classement général</span>, <span class="fst-italic">son classement à chaque course</span> et <span class="fst-italic">une fiche récapitulative</span> pour chacune de ses participations.</p>
                <h3 class="text-primary fw-bold">Des classements beaucoup plus lisibles</h3>
                <p>Fini de devoir scroller à l'infini en espérant tomber sur son pseudo... Désormais, si vous êtes connectés avec votre compte, la ligne correspondant à votre classement <span class="fw-bold">apparaitra automatiquement en orange</span> au milieu de toutes les autres lignes du classement.</p>
                <div>
                    <a class="btn btn-primary" href="<?= $this->router->generate('rules') ?>">Découvrir les règles du jeu en détails</a>
                </div>
            </article>

            <?php if (!$_SESSION) : ?>
            <div class="bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
                <a class="btn btn-outline-danger" href="<?= $this->router->generate('user-inscription') ?>">INSCRIVEZ-VOUS MAINTENANT</a>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-12 col-sm-4">

            <div>
                <table class="table table-light table-hover table-striped shadow align-middle">
                    <thead>
                        <tr>
                            <th colspan="3">Classement général</th>
                        </tr>
                        <th>Place</th>
                        <th>Pseudo</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php if (!empty($players)) : ?>
                            <?php foreach ($players as $player) : ?>
                                <tr <?= (isset($_SESSION['user']) && ($_SESSION['user']->getPseudo() === $player['pseudo'])) ? 'class="table-warning"' : "" ?>
                            <?= ($player['place'] == 1) ? 'class="table-success"' : "" ?>>
                                    <td><?= $player['place'] ?></td>
                                    <td><?= $player['pseudo'] ?> </td>
                                    <td><?= $player['general'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">Prochainement, le classement général...</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <td colspan="3"><a href="<?= $this->router->generate('general', ['year' => date('Y')]) ?>">Voir plus</a></td>
                    </tfoot>
                </table>
            </div>

            <div> 
                <table class="table  table-light table-hover table-striped shadow align-middle">
                    <thead>
                        <tr>
                            <th colspan="3">Dernière épreuve : <?= ($race) ? $race->getName() : '' ?></th>
                        </tr>
                        <th>Place</th>
                        <th>Pseudo</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php if (!empty($playersForRace)) : ?>
                            <?php foreach ($playersForRace as $player) : ?>
                                <tr <?= (isset($_SESSION['user']) && ($_SESSION['user']->getPseudo() === $player['pseudo'])) ? 'class="table-warning"' : "" ?>
                            <?= ($player['place'] == 1) ? 'class="table-success"' : "" ?>>
                                    <td><?= $player['place'] ?></td>
                                    <td><?= $player['pseudo'] ?> </td>
                                    <td><?= $player['score'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">A venir...</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <?php if ($race) : ?>
                            <td colspan="3"><a href="<?= $this->router->generate('results', ['year' => date('Y'), 'id' => $race->getId()]) ?>">Voir plus</a></td>
                        <?php else : ?>
                            <td colspan="3">...</td>
                        <?php endif; ?>
                    </tfoot>
                </table>
            </div>

        </div>
</div>

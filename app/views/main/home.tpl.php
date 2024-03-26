<?php if ($gameInProgress && !$participationForRaceInProgress) : ?>
    <a class="col-10 col-sm-6 mt-3 m-auto btn btn-danger shadow" href="<?= $this->router->generate('user-add', ['id' => $raceInProgress->getId()]) ?>">LES PARTICIPATIONS POUR <?= $raceInProgress->getName() ?> SONT OUVERTES ! CLIQUEZ ICI POUR PARTICIPER ! </a>
<?php elseif ($gameInProgress && $participationForRaceInProgress) : ?>
    <a class="col-10 col-sm-6 mt-3 m-auto btn btn-success shadow" href="<?= $this->router->generate('user-recap', ['id' => $raceInProgress->getId()]) ?>">Vous avez participé pour <?= $raceInProgress->getName() ?> ! Cliquez ici pour découvrir votre fiche récap' ! </a>
<?php endif; ?>

<div class="row mt-3 m-auto align-items-center">
        <div class="col-12 col-sm-8">
            <article class="bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
                <h2 class="fw-bold fst-italic fs-1">Pron'Autocross saison 4 </h2>
                <p>Bienvenue dans cette nouvelle saison de <span class="fst-italic text-decoration-underline">Pron'Autocross</span> !</p>
                <h3 class="text-primary fw-bold">Des cotes affinées</h3>
                <p>La recette qui a fait le succès de Pron'Autocross la saison dernière avec 1000 inscriptions est toujours d'actualité ! Une question par catégorie, deux questions bonus et ... des coups de poker à tenter !</p>
                <p>Pour débuter la saison, un nouveau système de calcul de cotes est en place : celui-ci ne se base plus seulement sur le classement au championnat et le nombre de votes reçus sur les deux dernières épreuves mais ... sur <span class="fw-bold text-decoration-underline">tous les résultats de la saison 2023</span> (des essais chronométrés aux finales en passant par les manches) !</p>
                <h3 class="text-primary fw-bold">Quelle stratégie pour la première de l'année ?</h3>
                <p>Alors, allez-vous être prudents, ne miser que sur des "valeurs sûres" pour l'ouverture de la saison ? Ou avez-vous suffisamment été observateurs la saison dernière pour étudier les montées en puissance ou les nouveaux pilotes venant des challenges régionaux ? Peut-être allez-vous être tenté de voter pour des pilotes changeant de catégorie et avec une cote forcément à 10 ? À vous de voir...</p>

            </article>

            <!--<article class="bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
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
            </article>-->

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

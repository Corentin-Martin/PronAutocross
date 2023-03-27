<div class="row mt-3 m-auto justify-content-center">
        <article class="col-10 bg-light rounded-3 mb-2 p-2 shadow lh-1" style="--bs-bg-opacity: .7;">
            <h2 class="fw-bold fst-italic fs-1">Les règles du jeu</h2>
            <p>Si vous avez déjà participé les saisons précédentes, le principe général reste le même : <strong>9 catégories - 9 questions + 2 questions bonus</strong> !</p>
            <p>En revanche, il y a UN <strong>changement majeur</strong>, désormais, une bonne réponse ne vaudra plus forcément 10 points mais ... <span class="fst-italic text-decoration-underline">entre 10 et 200 points</span> !</p>
            <h3 class="text-primary fw-bold">Les cotes</h3>
            <p>A chaque course, la cote de chaque pilote variera et ce sont <span class="fst-italic text-decoration-underline">vos votes</span> qui vont les influencer !</p>
            <p>En effet, le calcul sera un mélange des <span class="fw-bold">votes reçus sur les deux épreuves précédentes</span> et d'un coefficient déterminé par <span class="fw-bold">la place du pilote au championnat</span>.</p>
            <p>Un pilote archi-favori aura une cote qui aura tendance à s'approcher de 1,01 tandis que les pilotes apparaissant moins souvent aux avants-postes auront une cote plus élevée (jusqu'à 14,5).</p>
            <table class="table table-light shadow">
                <thead>
                    <th>Pilote</th>
                    <th>Cote</th>
                    <th>Gain potentiel</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Max Verstappen</td>
                        <td>1,01</td>
                        <td>10,1 points</td>
                    </tr>
                    <tr>
                        <td>Pierre Gasly</td>
                        <td>3,85</td>
                        <td>38,5 points</td>
                    </tr>
                    <tr>
                        <td>Jean-Frédéric Goldspeed</td>
                        <td>14,5</td>
                        <td>145 points</td>
                    </tr>
                </tbody>
            </table>
            <p>En clair, si vous votez pour Max Verstappen et qu'il vous donne raison, <span class="fw-bold">vous empocherez 10,1 points</span>. En revanche, si vous êtes un des rares à parier sur Jean-Frédéric Goldspeed et qu'à la surprise générale il s'impose, <span class="fw-bold">vous marquerez 145 points</span> et ferez un bond spectaculaire au classement !</p>
            <p>Vous l'avez compris, il faudra <span class="fw-bold">faire preuve de stratégie</span>, savoir assurer avec le favori sur certaines questions et tenter des coups sur d'autres questions !</p>
            <p><span class="fst-italic">Sur les questions où les bonnes réponses sont multiples</span> (Citez un pilote sur le podium, Qui finira dans le Top 5, ...), ne prendre aucun risque et miser quoi qu'il arrive sur l'homme fort du championnat <span class="text-decoration-underline">ne sera plus forcément la solution idéale</span> ! Mais à quel point allez-vous être joueur et tenter des gros coups ?</p>
            <p>Et si tout le monde prend des risques et que les votes s'éparpillent, il y a de fortes chances pour que les cotes des favoris remontent pour les épreuves suivantes et que les gros coups <span class="fst-italic">ne soient plus forcément ceux auxquels on s'attend</span>... </p>
            <p>Pour résumé, il ne faudra plus voter automatiquement en se fiant simplement au dernier résultat ou au classement du championnat, <span class="fw-bold">il faudra réfléchir et être joueur</span> !</p>
            <hr>
            <h3 class="text-primary fw-bold">A savoir</h3>
            <ul class="lh-5">
                <li>Pour le début de championnat, les cotes sont calculées <span class="text-decoration-underline">par rapport à la fin de saison 2022</span> pour les pilotes restant dans la même catégorie.</li>
                <li>Les pilotes changeant de catégorie démarreront <span class="text-decoration-underline">avec une cote à 10</span>.</li>
                <li><span class="fw-bold">Aucun pilote n'aura la cote maximale pour l'ouverture de la saison</span>. Celle-ci est rabaissée à 10.</li>
                <li>Un pilote invité participant à sa première épreuve de la saison se verra automatiquement attribuer <span class="text-decoration-underline">une cote de 10</span>.</li>
                <li>Les questions bonus sont toujours là et elles rapportent toujours <span class="text-decoration-underline">20 points chacune</span>.</li>
                <li>Attention, les votes seront <span class="fw-bold text-decoration-underline">automatiquement clos à 8h45</span> chaque samedi matin ! Le formulaire sera inaccessible...</li>
            </ul>
            <?php if (!$_SESSION) : ?>
                <hr>
                <a class="btn btn-outline-danger" href="<?= $this->router->generate('user-inscription') ?>">INSCRIVEZ-VOUS MAINTENANT</a>
            <?php endif; ?>
        </article>
</div>
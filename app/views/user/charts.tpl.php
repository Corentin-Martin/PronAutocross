<h3 class="col-8 col-sm-5 bg-primary mt-3 mx-auto p-2 text-light rounded-4 shadow">Vos résultats</h3>

<div class="row m-auto justify-content-center mt-3 bg-light" style="max-width: 85%;">
    <canvas id="myChart" style="height:50vh;"></canvas>
</div>

<a type="button" class="btn btn-dark btn-lg mt-3 mb-2 col-10 col-sm-5"  href="<?= $this->router->generate('user-dashboard') ?>">Retour sur votre tableau de bord personnel</a>
</div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {
        labels: <?= $racesJson ?>,
        datasets: [{
            label: 'Classement',
            data: <?= $placesJson ?>,
            borderWidth: 1,
            tension: 0.4,
            fill: false,
            borderColor: '#75CAEB',
        }]
        },
        options: {
        scales: {
            y: {
            min: 1,
            max: <?= $nbPlayers ?>,
            reverse: true
            }
        }
        }
    });
    </script>
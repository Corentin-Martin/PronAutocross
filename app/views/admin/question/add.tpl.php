<div class="row mt-3 justify-content-center">

    <?php if ($questionnaire) : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer le questionnaire</h2>
    <?php else : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Générer un questionnaire</h2>
    <?php endif; ?>

    <div class="col-12">
        <form action="" method="post">
            <input type="hidden" name="year" value="<?= date('Y') ?>">

            <div class="mb-2 col-12">
                <label class="col-8" for="raceId">
                    <h4 class="bg-primary rounded-4 shadow fw-bold p-2">Course</h4>
                    <select name="raceId" id="raceId" required>
                        <?php if ($questionnaire) : ?>
                            <option value="<?= $questionnaire->getRaceId() ?>" selected><?= $racesById[$questionnaire->getRaceId()]->getName() ?></option>
                        <?php endif; ?>
                        <?php foreach ($races as $race) : ?>
                            <option value="<?= $race->getId() ?>"><?= $race->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <?php foreach ($categories as $category) : ?>
                <div class="mb-2 col-12">
                    <label class="col-8" for="<?= $category->getId() ?>">
                        <h4 class="bg-primary rounded-4 shadow fw-bold p-2"><?= $category->getName() ?></h4>
                        <input type="text" class="form-control mb-2" name="<?= $category->getName() ?>" id="<?= $category->getId() ?>" placeholder="<?= $category->getName() ?>" <?= ($questionnaire) ? "value = \" {$questionnaire->{'get'.str_replace(" ", "", $category->getName())}()} \"" : "" ?> required>
                    </label>
                </div>
            <?php endforeach; ?>

            <div class="mb-2 col-12">
                <label class="col-8" for="bonus1">
                    <h4 class="bg-primary rounded-4 shadow fw-bold p-2">Bonus 1</h4>
                    <input type="text" class="form-control mb-2" name="bonus1" id="bonus1" placeholder="Bonus 1" <?= ($questionnaire) ? "value = \" {$questionnaire->getBonus1()} \"" : "" ?>required>
                </label>
            </div>

            <div class="mb-2 col-12">
                <label class="col-8" for="bonus2">
                    <h4 class="bg-primary rounded-4 shadow fw-bold p-2">Bonus 2</h4>
                    <input type="text" class="form-control mb-2" name="bonus2" id="bonus2" placeholder="Bonus 2" <?= ($questionnaire) ? "value = \" {$questionnaire->getBonus2()} \"" : "" ?>required>
                </label>
            </div>

            <div>
                <button class="btn btn-success btn-lg" type="submit">
                    <?php if ($questionnaire) : ?>
                        Editer le questionnaire
                    <?php else : ?>
                        Générer le questionnaire
                    <?php endif; ?>
                </button>
            </div>

            <?php $token = $_SESSION['token'] = random_bytes(5); ?>
            <input type="hidden" name="token" value="<?= $token ?>">
        </form>
    </div>
        
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('question-home') ?>">Retour</a>

</div>
<div class="admin__container">

<?php if ($questionnaire) : ?>
    <h2 class="admin__container__title">Editer le questionnaire</h2>
<?php else : ?>
    <h2 class="admin__container__title">Générer un questionnaire</h2>
<?php endif; ?>

    <div>
    <form action="" method="post">
    <input type="hidden" name="year" value="<?= date('Y') ?>">

    <div>
        <label for="raceId">
            <h4 class="questionnaire__title">Course</h4>
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

        <div>
            <label for="<?= $category->getId() ?>">
                <h4 class="questionnaire__title"><?= $category->getName() ?></h4>
                <input type="text" name="<?= $category->getName() ?>" id="<?= $category->getId() ?>" placeholder="Question pour <?= $category->getName() ?>" size="60" <?= ($questionnaire) ? "value = \" {$questionnaire->{'get'.str_replace(" ", "", $category->getName())}()} \"" : "" ?> required>
            </label>
        </div>
    <?php endforeach; ?>
        <div>
            <label for="bonus1">
                <h4 class="questionnaire__title">Bonus 1</h4>
                <input type="text" name="bonus1" id="bonus1" placeholder="Question Bonus 1" size="60" <?= ($questionnaire) ? "value = \" {$questionnaire->getBonus1()} \"" : "" ?>required>
            </label>
        </div>
        <div>
            <label for="bonus2">
                <h4 class="questionnaire__title">Bonus 2</h4>
                <input type="text" name="bonus2" id="bonus2" placeholder="Question Bonus 2" size="60" <?= ($questionnaire) ? "value = \" {$questionnaire->getBonus2()} \"" : "" ?>required>
            </label>
        </div>
        <div>
            <button class="btn btn-success btn-lg" type="submit">
                <?php if ($questionnaire) : ?>
                    Editer le questionnaire
                <?php else : ?>
                    Générer le questionnaire
                <?php endif; ?></button>
        </div>
</form>

    </div>
    

    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $router->generate('question-home') ?>">Retour</a>
    </div>


</div>
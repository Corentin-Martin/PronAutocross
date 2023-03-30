
<div class="admin__container">

    <?php if ($verification) : ?>
        <h2 class="admin__container__title">Editer la vérification</h2>
    <?php else : ?>
        <h2 class="admin__container__title">Générer une vérification</h2>
    <?php endif; ?>

    <div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Course</button>
            
            <ul class="dropdown-menu">
                <?php foreach ($racesById as $race) : ?>
                    <li><a class="dropdown-item" href="<?= $this->router->generate('verification-adding', ['raceId' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
                <?php endforeach; ?>
            </ul>
    </div>


    <div>
        <form action="" method="post">
            <input type="hidden" name="yearId" value="<?= date('Y') ?>">
            <input type="hidden" name="raceId" value="<?= $currentRace ?>">

    <?php if($currentRace) : foreach ($categories as $category) : ?>
        <div>
            <h4><?= $category->getName() ?></h4>

            <label for="<?= $categoriesOnDB[$category->getId()] ?>">
                <h4 class="questionnaire__title"><?= $questions->{'get'.$categoriesOnDB[$category->getId()]}() ?></h4>

                <?php for ($i = 1; $i < 6; $i++) : ?>

                <select name="<?= $categoriesOnDB[$category->getId()].$i ?>" id="<?= $categoriesOnDB[$category->getId()] ?>">

                    <?php if ($verification) : ($i == 1) ? ($test = '') : ($test = $i) ; ?>
                        <option value="<?=$verification->{'get'.$categoriesOnDB[$category->getId()].$test}()?>" selected><?= $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()].$test}()]->getNumber() . " - " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()].$test}()]->getFirstName() . " " . $driversById[$verification->{'get'.$categoriesOnDB[$category->getId()].$test}()]->getLastName() ?></option>
                    <?php endif; ?>
                        <option value="0">/</option>
                    <?php foreach ($entryList[$category->getId()] as $entry) : ?>
                        <option value="<?= $entry->getId() ?>"><?= $entry->getNumber() . " - " . $entry->getFirstName() . " " . $entry->getLastName() ?></option>
                    <?php endforeach; ?>

                </select>

                <?php endfor ; ?>
            </label>
        </div>
    <?php endforeach; ?>
        <div>
            <h4>Bonus 1</h4>

            <label for="bonus1">
                <h4 class="questionnaire__title"><?= $questions->getBonus1() ?></h4>

                <select name="bonus1" id="bonus1">
                    <?php if ($verification) : ?>
                        <option value="<?=$verification->getBonus1()?>" selected><?=$verification->getBonus1()?></option>
                    <?php endif; ?>
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                </select>

        </div>

        <div>
            <h4>Bonus 2</h4>

            <label for="bonus2">
                <h4 class="questionnaire__title"><?= $questions->getBonus2() ?></h4>

                <select name="bonus2" id="bonus2">
                    <?php if ($verification) : ?>
                        <option value="<?=$verification->getBonus2()?>" selected><?=$verification->getBonus2()?></option>
                    <?php endif; ?>
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                </select>
                
        </div>

        <div>
            <button class="btn btn-success btn-lg" type="submit">
                <?php if ($verification) : ?>
                    Editer la vérification
                <?php else : ?>
                    Générer la vérification
                <?php endif; endif;?></button>
        </div>

        <?php $token = $_SESSION['token'] = random_bytes(5); ?>
        <input type="hidden" name="token" value="<?= $token ?>">

    </form>
    </div>
    
    <div>
        <a type="button" class="btn btn-warning btn-lg"  href="<?= $this->router->generate('verification-home') ?>">Retour</a>
    </div>

</div>
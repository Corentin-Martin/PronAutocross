
<div class="row mt-3 justify-content-center">

    <?php if ($verification) : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Editer la vérification</h2>
    <?php else : ?>
        <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Générer une vérification</h2>
    <?php endif; ?>


    <div class="btn-group mb-2 col-6" role="group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Course</button>
        
        <ul class="dropdown-menu">
            <?php foreach ($racesById as $race) : ?>
                <li><a class="dropdown-item" href="<?= $this->router->generate('verification-adding', ['raceId' => $race->getId()]) ?>"><?= $race->getName() ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>


    <div class="col-12 mb-2">
        <form action="" method="post">
            <input type="hidden" name="yearId" value="<?= date('Y') ?>">
            <input type="hidden" name="raceId" value="<?= $currentRace ?>">

    <?php if($currentRace) : foreach ($categories as $category) : ?>
        <div>
            <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3"><?= $category->getName() ?></h4>

            <label class="col-12" for="<?= $categoriesOnDB[$category->getId()] ?>">
                <h4 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->{'get'.$categoriesOnDB[$category->getId()]}() ?></h4>

                <?php for ($i = 1; $i < 6; $i++) : ?>

                <select class="col-3" name="<?= $categoriesOnDB[$category->getId()].$i ?>" id="<?= $categoriesOnDB[$category->getId()] ?>">

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
            <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3">Bonus 1</h4>

            <label class="col-12" for="bonus1">
                <h4 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->getBonus1() ?></h4>

                <select class="col-6" name="bonus1" id="bonus1">
                    <?php if ($verification) : ?>
                        <option value="<?=$verification->getBonus1()?>" selected><?=$verification->getBonus1()?></option>
                    <?php endif; ?>
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                </select>

        </div>

        <div>
            <h4 class="bg-primary rounded-4 shadow fw-bold p-2 mt-3">Bonus 2</h4>

            <label class="col-12" for="bonus2">
                <h4 class="bg-info rounded-4 shadow fst-italic p-2"><?= $questions->getBonus2() ?></h4>

                <select class="col-6" name="bonus2" id="bonus2">
                    <?php if ($verification) : ?>
                        <option value="<?=$verification->getBonus2()?>" selected><?=$verification->getBonus2()?></option>
                    <?php endif; ?>
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                </select>
                
        </div>

        <div>
            <button class="btn btn-success btn-lg mt-3" type="submit">
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
    
    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('verification-home') ?>">Retour</a>


</div>
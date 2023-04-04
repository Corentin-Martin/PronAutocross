<?php $token = $_SESSION['token'] = random_bytes(5); ?>
<div class="row mt-3 justify-content-center">
    
    <h2 class="bg-danger text-light rounded-4 shadow fw-bold col-8 p-2">Liste des utilisateurs</h2>

    <p class="col-6 bg-light rounded-4 m-2 p-2 shadow">Nombre d'inscrits : <span class="btn btn-outline-danger shadow fw-bold fst-italic"><?= $total ?></span></p>

    <div class="btn-group col-6" role="group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Trier par</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'id']) ?>">Id</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'pseudo']) ?>">Pseudo</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'firstName']) ?>">Prénom</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'lastName']) ?>">Nom de famille</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'mail']) ?>">Adresse mail</a></li>
            <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-list', ['action' => 'role']) ?>">Role</a></li>
        </ul>
    </div>

    <div class="col-12 overflow-auto mt-3">
        <table class="table table-dark table-stripped table-striped-columns table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Adresse mail</th>
                    <th>Rôle</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->getId()?></td>
                        <td><?= $user->getPseudo() ?></td>
                        <td><?= $user->getFirstName() ?></td>
                        <td><?= $user->getLastName() ?></td>
                        <td><?= $user->getMail() ?></td>
                        <td><?= $user->getRole() ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-warning" href="<?= $this->router->generate('adminuser-edit', ['id' => $user->getId()]) ?>">Modifier</a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Supprimer</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Non</a></li>
                                    <li><a class="dropdown-item" href="<?= $this->router->generate('adminuser-delete', ['id' => $user->getId(), 'token' => bin2hex($token)]) ?>">Confirmer la suppression</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a type="button" class="btn btn-warning btn-lg mt-3 col-8"  href="<?= $this->router->generate('adminuser-home') ?>">Retour</a>

</div>

<section>
    <h1>Commandes</h1>
    <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
    <h3 class="mt-4">En attentes</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Menus</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Client</th>
                <th>Livraison</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['en_attente'] as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->date_commande ?></td>
                    <td><?= $commande->prenom . ' ' . $commande->nom ?> <br> <?= $commande->telephone ?> <br> <?= $commande->adresse ?></td>
                    <td>
                        <form action="/commande/confirm/<?= $commande->id ?>" method="post">
                            <select class="form-select bcommande-primary mb-2" name="id_livreur">
                                <?php foreach ($livreurs as $livreur): ?>
                                    <option value="<?= $livreur->id ?>"><?=  $livreur->prenom . ' ' . $livreur->nom ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Valider</button>
                                <a href="/commande/delete/<?= $commande->id ?>" class="btn btn-danger">Annuler</a>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 class="mt-4">En cours</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Menus</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Client</th>
                <th>Livreur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['en_cours'] as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->date_commande ?></td>
                    <td><?= $commande->prenom . ' ' . $commande->nom ?> <br> <?= $commande->telephone ?> <br> <?= $commande->adresse ?></td>
                    <td><?= $commande->livreur->prenom . ' ' . $commande->livreur->nom ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3 class="mt-4">Livrées</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Menus</th>
                <th>Prix</th>
                <th>Client</th>
                <th>Livreur</th>
                <th>Date livraison</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['livree'] as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->prenom . ' ' . $commande->nom ?> <br> <?= $commande->telephone ?> <br> <?= $commande->adresse ?></td>
                    <td><?= $commande->livreur->prenom . ' ' . $commande->livreur->nom ?></td>
                    <td><?= $commande->livreur->date_fin ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section>
    <h1>Mes commandes</h1>
   
    <h3 class="mt-4">En attentes</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Menus</th>
                <th>Prix</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['en_attente'] as $commande): ?>
                <tr>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->date_commande ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 class="mt-4">En cours</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Menus</th>
                <th>Prix</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['en_cours'] as $commande): ?>
                <tr>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->date_commande ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3 class="mt-4">Livrées</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Menus</th>
                <th>Prix</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes['livree'] as $commande): ?>
                <tr>
                    <td>
                        <ul>
                            <?php foreach ($commande->menus as $menu): ?>
                                <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?= $commande->prix ?> €</td>
                    <td><?= $commande->livreur->date_fin ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

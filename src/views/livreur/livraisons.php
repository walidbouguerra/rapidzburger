<section>
    <h1>Livraisons</h1>
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Menus</th>
            <th>Client</th>
            <th></th>
        </tr>
        <?php foreach ($livraisons as $livraison): ?>
            <tr>
                <td><?= $livraison->date_debut ?></td>
                <td>
                    <ul>
                        <?php foreach ($livraison->menus as $menu): ?>
                            <li><?= $menu->quantite ?>x Menu <?= $menu->nom ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td><?= $livraison->prenom . ' ' . $livraison->nom?> <br> <?= $livraison->adresse ?> <br> <?= $livraison->telephone ?></td>
                <td><a href="delivery/delivered/<?= $livraison->id ?>" class="btn btn-primary">Valider</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
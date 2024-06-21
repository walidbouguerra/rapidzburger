<section>
    <h1 class="mb-4">Panier</h1>
    <div class="row align-items-center justify-content-between">
        <div class="col-md-8 col-sm-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($panier as $menu): ?>
                        <tr>
                            <td>Menu : <?= $menu->nom ?></td>
                            <td><a class="btn btn-danger btn-sm me-2 rounded-0" style="width: 28px;" href="/panier/reduce/<?= $menu->id?>">-</a> <?= $menu->quantite ?> <a class="btn btn-danger btn-sm ms-2 rounded-0" style="width: 28px;" href="/panier/add/<?= $menu->id?>">+</a></td>
                            <td><?= $menu->prix * $menu->quantite ?> €</td>
                            <td><a class="btn btn-danger rounded-0" href="/panier/delete/<?= $menu->id?>">X</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <h3 class="mb-3">Total : <?=  $total ?> €</h3>
            <a class="btn btn-danger btn-lg" href="/panier/checkout">Procéder au paiement</a>
        </div>
    </div>
</section>

<section>
    <h1>Menus</h1>
    <table class="table">
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th><a href="/admin/addmenu" class="btn btn-primary w-100">+ Ajouter</a></th>
            </tr>
            <?php foreach($menus as $menu): ?>
                <tr>
                    <td class="align-middle"><?= $menu->nom ?></td>
                    <td class="align-middle"><?= $menu->prix ?> €</td>
                    <td class="align-middle w-25"><?= $menu->description ?></td>
                    <td class="align-middle"><img src="img/<?= $menu->image ?>" alt="image du burger : <?= $menu->nom ?>" width="150" height="150"></td>
                    <td class="align-middle">
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/admin/updatemenu/<?= $menu->id ?>" class="btn btn-success">Modifier</a>
                            <a href="/menu/delete/<?= $menu->id ?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</section>

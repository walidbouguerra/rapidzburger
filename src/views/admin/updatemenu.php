<section>
    <h1 class="mb-4 text-center">Modifier un menu</h1>
    <form action="/menu/update/<?= $menu->id ?>" method="post" class="col-md-4 mx-auto col-sm-10" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $menu->nom ?>">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?= $menu->prix ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description"><?= $menu->description ?></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="form-label">Image</label>
            <img src="img/<?= $menu->image ?>" alt="image du buger <?= $menu->image ?>">
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Modifier</button>
    </form>
</section>
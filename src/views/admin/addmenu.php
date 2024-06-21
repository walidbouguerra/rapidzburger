<section>
    <h1 class="mb-4 text-center">Ajouter un menu</h1>
    <form action="/menu/add" method="post" class="col-md-4 mx-auto col-sm-10" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Ajouter</button>
    </form>
</section>
<section>
    <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
    <form action="/commande/add" method="post" class="row mt-4 justify-content-between">
        <div class="col-md-6">
                <h2 class="mb-3">Livraison</h2>
                <div class="mb-4">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse">
                </div>    
                <div class="mb-4">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="telephone" name="telephone">
                </div>    
            </div>
            <div class="col-md-4">
                <div class="mb-4">
                    <h2 class="mb-3">Paiement</h2>
                    <label for="cb" class="form-label">Numéro carte bancaire</label>
                    <input type="text" class="form-control" id="cb" name="cb">
                </div>
                <h3 class="my-5">Total commande : <?= $total ?> €</h3>
                <button type="submit" class="btn btn-danger btn-lg w-100">Payer</button>
        </div>
    </form>
</section>
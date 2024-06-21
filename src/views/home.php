<div class="row flex-lg-row-reverse align-items-center g-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/hero.jpg" class="d-block mx-lg-auto img-fluid" alt="photo de burgers" width="500"
            height="300" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Découvrez nos burgers</h1>
        <p class="lead">Faites-vous livrer nos burgers frais préparés à partir de recettes élaborées par des chefs reconnus.</p>
    </div>
</div>
<section class="mt-4">
    <h2 class="mb-3">🍟 Menus</h2>
    <div class="row">
        <?php foreach($menus as $menu): ?>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
            <div class="card h-100" style="max-width: 18rem;">
                <img src="img/<?= $menu->image ?>" class="card-img-top" alt="photo du burger <?= $menu->nom ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $menu->nom ?></h5>
                    <h6><?= $menu->prix ?> €</h6>
                    <p class="card-text"><?= $menu->description ?></p>
                    <a href="/panier/add/<?= $menu->id ?>" class="btn btn-danger mt-auto">🛒 Ajouter au panier</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
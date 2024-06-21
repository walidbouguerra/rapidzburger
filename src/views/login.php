<div class="row">
    <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
    <form action="/user/verify" class="col-md-4 mx-auto col-sm-10" method="post">
        <h1 class="mb-4">Se connecter</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-danger">Connexion</button>
    </form>
</div>
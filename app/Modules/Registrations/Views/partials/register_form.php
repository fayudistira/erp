<?php if (session('error') !== null) : ?>
    <div class="alert alert-danger"><?= esc(session('error')) ?></div>
<?php endif ?>

<form action="<?= url_to('register') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-floating mb-2">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= old('email') ?>" required>
        <label>Email</label>
    </div>
    <div class="form-floating mb-4">
        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= old('username') ?>" required>
        <label>Username</label>
    </div>
    <div class="form-floating mb-2">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <label>Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password_confirm" placeholder="Konfirmasi Password" required>
        <label>Konfirmasi Password</label>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary-yellow">Daftar Sekarang</button>
    </div>
</form>
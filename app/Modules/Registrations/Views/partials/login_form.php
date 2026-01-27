<?php if (session('error') !== null) : ?>
    <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
<?php elseif (session('errors') !== null) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach (session('errors') as $error) : ?>
            <?= esc($error) ?><br>
        <?php endforeach ?>
    </div>
<?php endif ?>

<form action="<?= url_to('login') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
        <label><?= lang('Auth.email') ?></label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
        <label><?= lang('Auth.password') ?></label>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary-yellow"><?= lang('Auth.login') ?></button>
    </div>
</form>
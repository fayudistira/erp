<?= $this->extend('layouts/forntend/main_layout') ?>

<?= $this->section('style') ?>
<style>
    .login-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 360px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .form-control:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-wrapper">
    <div class="form-signin text-center">
        <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <h1 class="h3 mb-3 fw-normal"><?= lang('Auth.login') ?></h1>

            <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
            <?php endif ?>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                <label for="floatingInput"><?= lang('Auth.email') ?></label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                <label for="floatingPassword"><?= lang('Auth.password') ?></label>
            </div>

            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                <div class="checkbox mb-3 text-start">
                    <label>
                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked <?php endif ?>> <?= lang('Auth.rememberMe') ?>
                    </label>
                </div>
            <?php endif; ?>

            <button class="w-100 btn btn-lg btn-primary-yellow" type="submit"><?= lang('Auth.login') ?></button>

            <?php if (setting('Auth.allowRegistration')) : ?>
                <p class="mt-4 mb-3 text-muted"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
            <?php endif ?>

            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                <p class="mt-2 mb-3 text-muted"><a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
            <?php endif ?>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
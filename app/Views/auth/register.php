<?= $this->extend('layouts/frontend/main_layout') ?>

<?= $this->section('style') ?>
<style>
    .register-wrapper {
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

    /* Stacked Inputs Styling */
    .form-signin input[name="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[name="username"] {
        margin-bottom: -1px;
        border-radius: 0;
    }

    .form-signin input[name="password"] {
        margin-bottom: -1px;
        border-radius: 0;
    }

    .form-signin input[name="password_confirm"] {
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
<div class="register-wrapper">
    <div class="form-signin text-center">
        <form action="<?= url_to('register') ?>" method="post">
            <?= csrf_field() ?>

            <h1 class="h3 mb-3 fw-normal"><?= lang('Auth.register') ?></h1>

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

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingEmail" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                <label for="floatingEmail"><?= lang('Auth.email') ?></label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingUsername" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                <label for="floatingUsername"><?= lang('Auth.username') ?></label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                <label for="floatingPassword"><?= lang('Auth.password') ?></label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                <label for="floatingPasswordConfirm"><?= lang('Auth.passwordConfirm') ?></label>
            </div>

            <button class="w-100 btn btn-lg btn-primary-yellow" type="submit"><?= lang('Auth.register') ?></button>

            <p class="mt-4 mb-3 text-muted"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
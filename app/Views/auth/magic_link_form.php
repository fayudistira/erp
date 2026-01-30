<?= $this->extend('layouts/frontend/main_layout') ?>

<?= $this->section('style') ?>
<style>
    .magic-link-wrapper {
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
        margin-bottom: 10px;
    }

    .form-control:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="magic-link-wrapper">
    <div class="form-signin text-center">
        <form action="<?= url_to('magic-link') ?>" method="post">
            <?= csrf_field() ?>

            <h1 class="h3 mb-3 fw-normal">Request Login Link</h1>
            <p>Masuk melalui tautan yang dikirim ke email berikut</p>

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

            <button class="w-100 btn btn-lg btn-primary-yellow" type="submit"><?= lang('Auth.send') ?></button>

            <p class="mt-4 mb-3 text-muted"><a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
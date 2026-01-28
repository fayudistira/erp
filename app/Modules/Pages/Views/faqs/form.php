<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= isset($faq) ? 'Edit FAQ' : 'Tambah FAQ Baru' ?></h6>
                </div>
                <div class="card-body">
                    <?php $errors = session()->getFlashdata('errors'); ?>

                    <form action="<?= isset($faq) ? base_url('faq/update/' . $faq['id']) : base_url('faq/store') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label>Pertanyaan</label>
                            <input type="text" name="question" class="form-control <?= isset($errors['question']) ? 'is-invalid' : '' ?>" value="<?= old('question', $faq['question'] ?? '') ?>">
                            <div class="invalid-feedback"><?= $errors['question'] ?? '' ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <input type="text" name="category" class="form-control" value="<?= old('category', $faq['category'] ?? '') ?>" placeholder="Misal: Umum, Teknis">
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="publish" <?= old('status', $faq['status'] ?? '') == 'publish' ? 'selected' : '' ?>>Publish</option>
                                <option value="draft" <?= old('status', $faq['status'] ?? '') == 'draft' ? 'selected' : '' ?>>Draft</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Jawaban</label>
                            <textarea name="answer" class="form-control <?= isset($errors['answer']) ? 'is-invalid' : '' ?>" rows="5"><?= old('answer', $faq['answer'] ?? '') ?></textarea>
                            <div class="invalid-feedback"><?= $errors['answer'] ?? '' ?></div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('faq') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
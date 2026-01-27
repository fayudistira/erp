<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('style') ?>
<style>
    .registration-stepper {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .program-summary {
        background-color: var(--light-gray);
        border-left: 5px solid var(--primary-yellow);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-radius: 0 8px 8px 0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--black);
        margin-top: 2rem;
        margin-bottom: 1.2rem;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--primary-yellow);
        display: inline-block;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #444;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 0.25rem rgba(255, 221, 0, 0.25);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= esc(session('error')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="registration-stepper p-4 p-md-5">
                <h2 class="fw-bold mb-4 text-center">Form Pendaftaran Siswa</h2>

                <div class="program-summary">
                    <h5 class="fw-bold mb-3"><?= esc($program['title']) ?></h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Biaya Kursus</small>
                            <span class="fw-bold text-primary-yellow">Rp <?= number_format($program['tuition'], 0, ',', '.') ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Biaya Pendaftaran</small>
                            <span class="fw-bold">Rp <?= number_format($program['registrationfee'], 0, ',', '.') ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Durasi</small>
                            <span class="fw-bold"><?= esc($program['duration']) ?></span>
                        </div>
                    </div>
                </div>

                <?php if (!$isLoggedIn): ?>
                    <div id="auth-prompt" class="text-center py-5">
                        <img src="<?= base_url('assets/img/login_illustration.png') ?>" alt="Login First" class="img-fluid mb-4" style="max-height: 200px;">
                        <h4>Anda harus login terlebih dahulu</h4>
                        <p class="text-muted mb-4">Silakan masuk atau daftar akun baru untuk melanjutkan pendaftaran.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button onclick="showAuth('login')" class="btn btn-outline-dark px-4 rounded-pill">Masuk</button>
                            <button onclick="showAuth('register')" class="btn btn-primary-yellow px-4 rounded-pill">Daftar Akun</button>
                        </div>
                    </div>

                    <div id="auth-container-wrapper" class="d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 id="auth-title" class="mb-0 fw-bold">Login</h4>
                            <button onclick="hideAuth()" class="btn btn-sm btn-light rounded-circle"><i class="fas fa-times"></i></button>
                        </div>
                        <div id="auth-container" class="border rounded p-4 bg-light"></div>
                    </div>

                <?php else: ?>

                    <form action="<?= base_url('daftar/' . $program['id'] . '/submit') ?>" method="POST">
                        <?= csrf_field() ?>


                        <div class="section-title">Data Diri Siswa</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap (Sesuai Identitas) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="<?= old('nama_lengkap', $userProfile['nama_lengkap'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" class="form-control" name="nama_panggilan"
                                    value="<?= old('nama_panggilan', $userProfile['nama_panggilan'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">Pilih...</option>
                                    <option value="L" <?= (old('jenis_kelamin', $userProfile['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= (old('jenis_kelamin', $userProfile['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <div class="row g-2">
                                    <div class="col-7">
                                        <?php
                                        $ttlTempat = '';
                                        if (isset($userProfile['ttl']) && is_array($userProfile['ttl'])) {
                                            $ttlTempat = $userProfile['ttl']['tempat'] ?? '';
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="ttl[tempat]" placeholder="Kota"
                                            value="<?= old('ttl.tempat', $ttlTempat) ?>">
                                    </div>
                                    <div class="col-5">
                                        <?php
                                        $ttlTanggal = '';
                                        if (isset($userProfile['ttl']) && is_array($userProfile['ttl'])) {
                                            $ttlTanggal = $userProfile['ttl']['tanggal'] ?? '';
                                        }
                                        ?>
                                        <input type="date" class="form-control" name="ttl[tanggal]"
                                            value="<?= old('ttl.tanggal', $ttlTanggal) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <select class="form-select" name="agama">
                                    <?php $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']; ?>
                                    <option value="">Pilih...</option>
                                    <?php foreach ($agamas as $agm): ?>
                                        <option value="<?= $agm ?>" <?= (old('agama', $userProfile['agama'] ?? '') == $agm) ? 'selected' : '' ?>><?= esc($agm) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input type="text" class="form-control" name="pendidikan_terakhir"
                                    value="<?= old('pendidikan_terakhir', $userProfile['pendidikan_terakhir'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <?php
                                $alamatJalan = '';
                                $alamatKelurahan = '';
                                $alamatKecamatan = '';
                                $alamatKota = '';
                                $alamatProvinsi = '';

                                if (isset($userProfile['alamat']) && is_array($userProfile['alamat'])) {
                                    $alamatJalan = $userProfile['alamat']['jalan'] ?? '';
                                    $alamatKelurahan = $userProfile['alamat']['kelurahan'] ?? '';
                                    $alamatKecamatan = $userProfile['alamat']['kecamatan'] ?? '';
                                    $alamatKota = $userProfile['alamat']['kota'] ?? '';
                                    $alamatProvinsi = $userProfile['alamat']['provinsi'] ?? '';
                                }
                                ?>
                                <textarea class="form-control" name="alamat[jalan]" rows="2" placeholder="Nama Jalan, RT/RW" required><?= old('alamat.jalan', $alamatJalan) ?></textarea>
                                <div class="row mt-2 g-2">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="alamat[kelurahan]" placeholder="Kelurahan"
                                            value="<?= old('alamat.kelurahan', $alamatKelurahan) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="alamat[kecamatan]" placeholder="Kecamatan"
                                            value="<?= old('alamat.kecamatan', $alamatKecamatan) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="alamat[kota]" placeholder="Kota/Kab"
                                            value="<?= old('alamat.kota', $alamatKota) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="alamat[provinsi]" placeholder="Provinsi"
                                            value="<?= old('alamat.provinsi', $alamatProvinsi) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon / WA (Siswa) <span class="text-danger">*</span></label>
                                <?php
                                $telpPrimary = '';
                                if (isset($userProfile['telp']) && is_array($userProfile['telp'])) {
                                    $telpPrimary = $userProfile['telp']['primary'] ?? '';
                                } elseif (isset($userProfile['telp']) && is_string($userProfile['telp'])) {
                                    $telpPrimary = $userProfile['telp'];
                                }
                                ?>
                                <input type="text" class="form-control" name="telp"
                                    value="<?= old('telp', $telpPrimary) ?>" required>
                            </div>
                        </div>

                        <div class="section-title">Data Orang Tua / Wali (Kontak Darurat)</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kontak Darurat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kontak_darurat"
                                    value="<?= old('kontak_darurat', $userProfile['kontak_darurat'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hubungan</label>
                                <select class="form-select" name="hubungan">
                                    <option value="Orang Tua" <?= (old('hubungan', $userProfile['hubungan'] ?? '') == 'Orang Tua') ? 'selected' : '' ?>>Orang Tua</option>
                                    <option value="Wali" <?= (old('hubungan', $userProfile['hubungan'] ?? '') == 'Wali') ? 'selected' : '' ?>>Wali</option>
                                    <option value="Saudara" <?= (old('hubungan', $userProfile['hubungan'] ?? '') == 'Saudara') ? 'selected' : '' ?>>Saudara</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon Kontak Darurat <span class="text-danger">*</span></label>
                                <?php
                                $telpEmergency = '';
                                if (isset($userProfile['telp']) && is_array($userProfile['telp'])) {
                                    $telpEmergency = $userProfile['telp']['emergency'] ?? '';
                                } elseif (isset($userProfile['telp_kontak'])) {
                                    $telpEmergency = $userProfile['telp_kontak'];
                                }
                                ?>
                                <input type="text" class="form-control" name="telp_kontak"
                                    value="<?= old('telp_kontak', $telpEmergency) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Ayah Kandung</label>
                                <input type="text" class="form-control" name="nama_ayah"
                                    value="<?= old('nama_ayah', $userProfile['nama_ayah'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" name="nama_ibu"
                                    value="<?= old('nama_ibu', $userProfile['nama_ibu'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="section-title">Informasi Tambahan</div>
                        <div class="mb-4">
                            <label class="form-label">Catatan Khusus (Kondisi kesehatan, alergi, dll)</label>
                            <textarea class="form-control" name="catatan" rows="3"><?= old('catatan', $userProfile['catatan'] ?? '') ?></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3 border-top">
                            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary px-4 rounded-pill">Batal</a>
                            <button type="submit" class="btn btn-primary-yellow px-5 rounded-pill fw-bold">Kirim Pendaftaran</button>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    async function showAuth(type) {
        const prompt = document.getElementById('auth-prompt');
        const wrapper = document.getElementById('auth-container-wrapper');
        const container = document.getElementById('auth-container');
        const title = document.getElementById('auth-title');

        title.innerHTML = (type === 'login') ? '<i class="fas fa-sign-in-alt me-2"></i> Login Siswa' : '<i class="fas fa-user-plus me-2"></i> Pendaftaran Akun';
        prompt.classList.add('d-none');
        wrapper.classList.remove('d-none');
        container.innerHTML = `<div class="text-center py-5"><div class="spinner-border text-warning"></div></div>`;

        try {
            const response = await fetch(`<?= base_url('auth-form') ?>/${type}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                }
            });
            container.innerHTML = await response.text();
        } catch (error) {
            container.innerHTML = `<div class="alert alert-danger">Gagal memuat form. Silakan coba lagi.</div>`;
        }
    }

    function hideAuth() {
        document.getElementById('auth-prompt').classList.remove('d-none');
        document.getElementById('auth-container-wrapper').classList.add('d-none');
    }
</script>
<?= $this->endSection() ?>
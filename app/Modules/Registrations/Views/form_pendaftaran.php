<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('content') ?>
<section class="pendaftaran-section" style="padding: 100px 0; background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-header bg-primary text-white fw-bold">Program yang Dipilih</div>
                    <div class="card-body">
                        <h5 class="fw-bold"><?= $program['title'] ?></h5>
                        <p class="text-muted small"><?= $program['duration'] ?> • <?= $program['classtype'] ?></p>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Kursus:</span>
                            <span>Rp <?= number_format($program['tuition'], 0, ',', '.') ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pendaftaran:</span>
                            <span>Rp <?= number_format($program['registrationfee'], 0, ',', '.') ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between text-primary fw-bold">
                            <span>Total Pembayaran:</span>
                            <span>Rp <?= number_format($program['tuition'] + $program['registrationfee'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4">
                    <form action="<?= base_url('pendaftaran/submit') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="program_id" value="<?= $program['id'] ?>">

                        <h5 class="fw-bold text-primary mb-3"><i class="fas fa-user-circle me-2"></i>Identitas Siswa</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Aktif *</label>
                                <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">WhatsApp Utama *</label>
                                <input type="text" name="telp_utama" class="form-control" placeholder="0812..." required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nama Lengkap (Sesuai Ijazah) *</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Panggilan</label>
                                <input type="text" name="nama_panggilan" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" class="form-control" placeholder="Contoh: SMA">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>
                        </div>

                        <h5 class="fw-bold text-primary mt-4 mb-3"><i class="fas fa-map-marker-alt me-2"></i>Alamat Domisili</h5>
                        <div class="mb-3">
                            <label class="form-label">Alamat Jalan / No. Rumah</label>
                            <textarea name="alamat_jalan" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota / Kabupaten</label>
                                <input type="text" name="kota" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control">
                            </div>
                        </div>

                        <h5 class="fw-bold text-primary mt-4 mb-3"><i class="fas fa-users me-2"></i>Data Keluarga</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control">
                            </div>
                            <div class="col-md-12 mb-2">
                                <p class="small text-muted mb-2">Kontak Darurat (Wajib diisi jika siswa di bawah umur)</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Kontak</label>
                                <input type="text" name="kontak_darurat" class="form-control" placeholder="Nama wali">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Hubungan</label>
                                <input type="text" name="hubungan" class="form-control" placeholder="Contoh: Kakak">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Telp Kontak</label>
                                <input type="text" name="telp_kontak" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Medis atau Khusus (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Sebutkan jika ada alergi atau kebutuhan khusus..."></textarea>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Konfirmasi & Lanjutkan Ke Pembayaran</button>
                            <a href="<?= base_url('/') ?>" class="btn btn-light text-muted">Batalkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
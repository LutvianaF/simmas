<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="fw-bold mb-3">Pengaturan Sekolah</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif ?>

    <div class="row g-3">

        <!-- KIRI: FORM -->
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h6 class="fw-bold mb-3">Informasi Sekolah</h6>

                <form action="<?= base_url('admin/pengaturan/update/' . $sekolah['id']) ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-2">
                        <label class="form-label">Logo Sekolah</label>
                        <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah"
                            value="<?= esc($sekolah['nama_sekolah'] ?? '') ?>"
                            class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat"
                            class="form-control"><?= esc($sekolah['alamat'] ?? '') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon"
                                value="<?= esc($sekolah['telepon'] ?? '') ?>"
                                class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                value="<?= esc($sekolah['email'] ?? '') ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Website</label>
                        <input type="text" name="website"
                            value="<?= esc($sekolah['website'] ?? '') ?>"
                            class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Kepala Sekolah</label>
                        <input type="text" name="kepala_sekolah"
                            value="<?= esc($sekolah['kepala_sekolah'] ?? '') ?>"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NPSN</label>
                        <input type="text" name="npsn"
                            value="<?= esc($sekolah['npsn'] ?? '') ?>"
                            class="form-control">
                    </div>

                    <button class="btn btn-primary">Simpan Perubahan</button>
                </form>

            </div>
        </div>

        <!-- KANAN: PREVIEW -->
        <div class="col-md-6">
            <div class="card p-3 shadow-sm mb-3">
                <h6 class="fw-bold">Preview Tampilan</h6>
                <p class="text-muted small">Pratinjau informasi sekolah</p>

                <div class="d-flex align-items-center gap-3">
                    <?php if (!empty($sekolah['logo_url'])): ?>
                        <img src="<?= base_url($sekolah['logo_url']) ?>"
                            style="width:60px;height:60px;object-fit:contain;">
                    <?php endif ?>
                    <div>
                        <strong><?= esc($sekolah['nama_sekolah'] ?? '-') ?></strong><br>
                        <small>Sistem Informasi Magang</small>
                    </div>
                </div>
            </div>
            <div class="card p-3 shadow-sm mb-3">
                <h6 class="fw-bold">Dashboard Header</h6>

                <div class="preview-soft">
                    <div class="preview-header">
                        <?php if (!empty($sekolah['logo_url'])): ?>
                            <img src="<?= base_url($sekolah['logo_url']) ?>">
                        <?php else: ?>
                            <img src="<?= base_url('assets/img/logo-placeholder.png') ?>">
                        <?php endif ?>

                        <div>
                            <div class="fw-bold">
                                <?= esc($sekolah['nama_sekolah'] ?? '-') ?>
                            </div>
                            <small class="text-muted">
                                Sistem Informasi Magang
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 shadow-sm">
                <h6 class="fw-bold">Header Rapor / Sertifikat</h6>

                <div class="rapor-box mt-3">
                    <?php if (!empty($sekolah['logo_url'])): ?>
                        <img src="<?= base_url($sekolah['logo_url']) ?>">
                    <?php endif ?>

                    <h6 class="fw-bold mb-1">
                        <?= esc($sekolah['nama_sekolah'] ?? '-') ?>
                    </h6>

                    <small class="text-muted d-block">
                        <?= esc($sekolah['alamat'] ?? '-') ?>
                    </small>

                    <small class="text-muted d-block">
                        Telp: <?= esc($sekolah['telepon'] ?? '-') ?> |
                        Email: <?= esc($sekolah['email'] ?? '-') ?>
                    </small>

                    <small class="text-muted d-block">
                        Web: <?= esc($sekolah['website'] ?? '-') ?>
                    </small>

                    <hr>

                    <div class="fw-bold">
                        SERTIFIKAT MAGANG
                    </div>
                </div>
            </div>
            <div class="card p-3 shadow-sm mb-3">
                <h6 class="fw-bold mb-3">Dokumen Cetak</h6>

                <div class="d-flex gap-3">
                    <?php if (!empty($sekolah['logo_url'])): ?>
                        <img src="<?= base_url($sekolah['logo_url']) ?>"
                            style="width:50px;height:50px;object-fit:contain;">
                    <?php endif ?>

                    <div>
                        <div class="fw-bold">
                            <?= esc($sekolah['nama_sekolah'] ?? '-') ?>
                        </div>
                        <small class="text-muted">NPSN: <?= esc($sekolah['npsn'] ?? '-') ?></small><br>
                        <small class="text-muted"><?= esc($sekolah['alamat'] ?? '-') ?></small><br>
                        <small class="text-muted"><?= esc($sekolah['telepon'] ?? '-') ?></small><br>
                        <small class="text-muted"><?= esc($sekolah['email'] ?? '-') ?></small><br>
                        <small class="text-muted">
                            Kepala Sekolah: <?= esc($sekolah['kepala_sekolah'] ?? '-') ?>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card p-3 shadow-sm"
                style="background:#f3f8ff;border:1px solid #e3ecff;">
                <h6 class="fw-bold mb-3 text-primary">Informasi Penggunaan</h6>

                <div class="d-flex align-items-start gap-3 mb-2">
                    <i class="bi bi-layout-text-window fs-5 text-primary"></i>
                    <div>
                        <div class="fw-semibold">Dashboard</div>
                        <small class="text-muted">
                            Logo dan nama sekolah ditampilkan di header navigasi
                        </small>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-2">
                    <i class="bi bi-file-earmark-text fs-5 text-success"></i>
                    <div>
                        <div class="fw-semibold">Rapor / Sertifikat</div>
                        <small class="text-muted">
                            Informasi lengkap sebagai kop dokumen resmi
                        </small>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-printer fs-5 text-info"></i>
                    <div>
                        <div class="fw-semibold">Dokumen Cetak</div>
                        <small class="text-muted">
                            Footer atau header pada laporan yang dicetak
                        </small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
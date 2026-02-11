<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h5 class="mb-0">Tambah Jurnal Harian</h5>
                <small class="text-muted">Dokumentasikan kegiatan magang harian Anda</small>
            </div>
        </div>

        <div class="card-body">

            <!-- Panduan -->
            <div class="alert alert-primary">
                <strong>Panduan Penulisan Jurnal</strong>
                <ul class="mb-0 mt-2 small">
                    <li>Minimal 50 karakter untuk deskripsi kegiatan</li>
                    <li>Deskripsikan kegiatan dengan detail dan spesifik</li>
                    <li>Sertakan kendala yang dihadapi (jika ada)</li>
                    <li>Upload dokumentasi pendukung (opsional)</li>
                </ul>
            </div>

            <!-- Error -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $e): ?>
                        <div><?= esc($e) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?= base_url('siswa/jurnal/store') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="magang_id" value="<?= $magang_id ?>">

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal *</label>
                    <input type="date" name="tanggal" class="form-control"
                        value="<?= old('tanggal') ?>">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="Menunggu Verifikasi" readonly>
                </div>

                <!-- Kegiatan -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Kegiatan *</label>
                    <textarea name="kegiatan" class="form-control" rows="5"
                        placeholder="Tuliskan kegiatan yang Anda lakukan secara detail..."><?= old('kegiatan') ?></textarea>
                    <small class="text-muted">Minimal 50 karakter</small>
                </div>

                <!-- Kendala -->
                <div class="mb-3">
                    <label class="form-label">Kendala (Opsional)</label>
                    <textarea name="kendala" class="form-control" rows="3"><?= old('kendala') ?></textarea>
                </div>

                <!-- Upload -->
                <div class="mb-3">
                    <label class="form-label">Upload File (Opsional)</label>
                    <input type="file" name="file" class="form-control">
                    <small class="text-muted">PDF, DOC, DOCX, JPG, PNG (Max 2MB)</small>
                </div>

                <!-- Button -->
                <div class="text-end">
                    <a href="<?= previous_url() ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Jurnal</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
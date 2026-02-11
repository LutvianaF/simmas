<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h5 class="mb-0">Edit Jurnal Harian</h5>
                <small class="text-muted">
                    Perbarui dokumentasi kegiatan magang Anda
                </small>
            </div>
        </div>

        <div class="card-body">

            <!-- Panduan -->
            <div class="alert alert-primary">
                <strong>Panduan Penulisan Jurnal</strong>
                <ul class="mb-0 mt-2 small">
                    <li>Minimal 50 karakter untuk deskripsi kegiatan</li>
                    <li>Deskripsikan kegiatan secara detail dan spesifik</li>
                    <li>Upload dokumentasi pendukung jika perlu</li>
                </ul>
            </div>

            <!-- ALERT JIKA DITOLAK -->
            <?php if ($jurnal['status_verifikasi'] == 'ditolak'): ?>
                <div class="alert alert-warning">
                    <strong>Jurnal ini ditolak dan perlu diperbaiki.</strong>
                    <?php if (!empty($jurnal['catatan_guru'])): ?>
                        <hr>
                        <strong>Catatan Guru:</strong><br>
                        <?= nl2br(esc((string)$jurnal['catatan_guru'])) ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('siswa/jurnal/update/' . $jurnal['id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <!-- Informasi Dasar -->
                <h6 class="fw-bold mb-3">Informasi Dasar</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal *</label>
                        <input type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= old('tanggal', $jurnal['tanggal']) ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <input type="text"
                            class="form-control"
                            value="<?= ucfirst($jurnal['status_verifikasi']) ?>"
                            readonly>
                    </div>
                </div>

                <!-- Kegiatan -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Kegiatan *</label>
                    <textarea name="kegiatan"
                        class="form-control"
                        rows="5"
                        required><?= old('kegiatan', $jurnal['kegiatan']) ?></textarea>
                    <small class="text-muted">Minimal 50 karakter</small>
                </div>

                <!-- Kendala -->
                <div class="mb-3">
                    <label class="form-label">Kendala (Opsional)</label>
                    <textarea name="kendala"
                        class="form-control"
                        rows="3"><?= old('kendala', $jurnal['kendala']) ?></textarea>
                </div>

                <!-- File -->
                <div class="mb-3">
                    <label class="form-label">Upload File (Opsional)</label>
                    <input type="file" name="file" class="form-control">

                    <?php if (!empty($jurnal['file'])): ?>
                        <small class="text-muted d-block mt-1">
                            File saat ini:
                            <a href="<?= base_url('uploads/jurnal/' . $jurnal['file']) ?>" target="_blank">
                                <?= esc($jurnal['file']) ?>
                            </a>
                        </small>
                    <?php endif ?>
                </div>

                <!-- BUTTON -->
                <div class="text-end">
                    <a href="<?= base_url('siswa/jurnal') ?>" class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update Jurnal
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
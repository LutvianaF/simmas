<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Manajemen Jurnal Harian Magang</h4>

<!-- STATISTIK -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 card-stat">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Total Logbook</small>
                <i class="bi bi-people"></i>
            </div>
            <h3 class="fw-bold value"><?= $total ?></h3>
            <small>Laporan harian terdaftar</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 card-stat">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Belum Diverifikasi</small>
                <i class="bi bi-clock"></i>
            </div>
            <h3 class="fw-bold value"><?= $belum ?></h3>
            <small>Menunggu verifikasi</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 card-stat">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Disetujui</small>
                <i class="bi bi-check-circle"></i>
            </div>
            <h3 class="fw-bold value"><?= $disetujui ?></h3>
            <small>Sudah diverifikasi</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 card-stat">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Ditolak</small>
                <i class="bi bi-x-circle"></i>
            </div>
            <h3 class="fw-bold value"><?= $ditolak ?></h3>
            <small>Perlu perbaikan</small>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card card-hero-dash">
    <div class="card-header">
        <h6 class="mb-3">Daftar Logbook Siswa</h6>
    </div>
    <div class="card-body table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Siswa & Tanggal</th>
                    <th>Kegiatan & Kendala</th>
                    <th>Status</th>
                    <th>Catatan Guru</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logbook as $l): ?>
                    <tr>
                        <td>
                            <strong><?= $l['nama_siswa'] ?></strong><br>
                            <small><?= $l['nis'] ?></small><br>
                            <small><?= date('d M Y', strtotime($l['tanggal'])) ?></small>
                        </td>
                        <td>
                            <strong>Kegiatan:</strong><br>
                            <?= $l['kegiatan'] ?><br>
                            <strong>Kendala:</strong><br>
                            <em><?= $l['kendala'] ?: '-' ?></em>
                        </td>
                        <td>
                            <?php if ($l['status_verifikasi'] == 'disetujui'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php elseif ($l['status_verifikasi'] == 'ditolak'): ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Belum Diverifikasi</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $l['catatan_guru'] ?: '<em>Belum ada catatan</em>' ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#verifikasi<?= $l['id'] ?>">
                                Verifikasi
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php foreach ($logbook as $l): ?>
    <div class="modal fade" id="verifikasi<?= $l['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('guru/jurnal/verifikasi/' . $l['id']) ?>">
                <?= csrf_field() ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Verifikasi Logbook</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <select name="status" class="form-select mb-2">
                            <option value="disetujui" <?= $l['status_verifikasi'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="ditolak" <?= $l['status_verifikasi'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                        </select>
                        <textarea name="catatan_guru" class="form-control" placeholder="Catatan guru..."><?= esc($l['catatan_guru']) ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
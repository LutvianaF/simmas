<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>


<div class="d-flex">
    <h4 class="mb-4">Jurnal Harian Magang</h4>
    <a href="<?= base_url('siswa/jurnal/create') ?>" class="btn btn-primary mb-4">
        <i class="bi bi-plus-lg"></i> Tambah Jurnal
    </a>
</div>

<?php if (($statistik['total'] ?? 0) == 0): ?>
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <div>
            <strong>Jangan Lupa Jurnal Hari Ini!</strong><br>
            Anda belum membuat jurnal hari ini.
        </div>
        <a href="<?= base_url('siswa/jurnal/create') ?>" class="btn btn-warning btn-sm">
            Buat Sekarang
        </a>
    </div>
<?php endif ?>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['total'] ?? 0 ?></h5>
                <small>Total Jurnal</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['disetujui'] ?? 0 ?></h5>
                <small>Disetujui</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['pending'] ?? 0 ?></h5>
                <small>Menunggu</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['ditolak'] ?? 0 ?></h5>
                <small>Ditolak</small>
            </div>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card">
    <div class="card-header">
        Riwayat Jurnal
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan & Kendala</th>
                    <th>Status</th>
                    <th>Feedback Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logbook)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada jurnal
                        </td>
                    </tr>
                <?php endif ?>
                <?php foreach ($logbook as $row): ?>
                    <tr>
                        <td>
                            <?= $row['tanggal']
                                ? date('d M Y', strtotime($row['tanggal']))
                                : '-' ?>
                        </td>

                        <td>
                            <strong>Kegiatan:</strong><br>
                            <?= esc(substr($row['kegiatan'], 0, 80)) ?>...
                            <?php if ($row['kendala']): ?>
                                <br><strong>Kendala:</strong> <?= esc($row['kendala']) ?>
                            <?php endif ?>
                        </td>

                        <td>
                            <?php if ($row['status_verifikasi'] == 'disetujui'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php elseif ($row['status_verifikasi'] == 'ditolak'): ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            <?php endif ?>
                        </td>

                        <td>
                            <?= !empty($row['catatan_guru'])
                                ? esc($row['catatan_guru'])
                                : '<em>Belum ada feedback</em>' ?>
                        </td>

                        <td>
                            <!-- BUTTON DETAIL -->
                            <button
                                class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal<?= $row['id'] ?>">
                                Detail
                            </button>

                            <?php if ($row['status_verifikasi'] != 'disetujui'): ?>
                                <a href="<?= base_url('siswa/jurnal/edit/' . $row['id']) ?>"
                                    class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>

                                <a href="<?= base_url('siswa/jurnal/delete/' . $row['id']) ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin ingin menghapus jurnal ini?')">
                                    Hapus
                                </a>
                            <?php endif ?>
                        </td>
                    </tr>

                    <!-- ================= MODAL DETAIL ================= -->
                    <div class="modal fade" id="detailModal<?= $row['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- HEADER -->
                                <div class="modal-header">
                                    <div>
                                        <h5 class="modal-title mb-0">Detail Jurnal Harian</h5>
                                        <small class="text-muted">
                                            <?= date('l, d F Y', strtotime($row['tanggal'])) ?>
                                        </small>
                                    </div>

                                    <?php if ($row['status_verifikasi'] == 'disetujui'): ?>
                                        <span class="badge bg-success ms-2">Disetujui</span>
                                    <?php elseif ($row['status_verifikasi'] == 'ditolak'): ?>
                                        <span class="badge bg-danger ms-2">Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark ms-2">Menunggu</span>
                                    <?php endif ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- BODY -->
                                <div class="modal-body">

                                    <h6 class="fw-bold">Kegiatan Hari Ini</h6>
                                    <div class="p-3 border rounded bg-light mb-3">
                                        <?= nl2br(esc((string)$row['kegiatan'])) ?>
                                    </div>

                                    <?php if (!empty($row['kendala'])): ?>
                                        <h6 class="fw-bold">Kendala</h6>
                                        <div class="p-3 border rounded bg-light mb-3">
                                            <?= nl2br(esc((string)$row['kendala'])) ?>
                                        </div>
                                    <?php endif ?>

                                    <?php if (!empty($row['file'])): ?>
                                        <h6 class="fw-bold">Dokumentasi</h6>
                                        <div class="p-3 border rounded bg-success bg-opacity-10 
                                d-flex justify-content-between align-items-center mb-3">
                                            <span><?= esc((string)$row['file']) ?></span>
                                            <a href="<?= base_url('uploads/jurnal/' . $row['file']) ?>"
                                                class="btn btn-success btn-sm"
                                                download>
                                                Unduh
                                            </a>
                                        </div>
                                    <?php endif ?>

                                    <?php if (!empty($row['catatan_guru'])): ?>
                                        <h6 class="fw-bold text-success">Catatan Guru</h6>
                                        <div class="p-3 border rounded bg-success bg-opacity-10">
                                            <?= nl2br(esc((string)$row['catatan_guru'])) ?>
                                        </div>
                                    <?php endif ?>

                                </div>

                                <!-- FOOTER -->
                                <div class="modal-footer text-muted small d-flex justify-content-between w-100">
                                    <span>Dibuat: <?= date('d/m/Y', strtotime($row['created_at'])) ?></span>
                                    <span>Diperbarui: <?= date('d/m/Y', strtotime($row['updated_at'])) ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- ================= END MODAL ================= -->

                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
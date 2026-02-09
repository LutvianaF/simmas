<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Manajemen Jurnal Harian Magang</h4>

<!-- STATISTIK -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <small>Total Logbook</small>
            <h4><?= $total ?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <small>Belum Diverifikasi</small>
            <h4><?= $belum ?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <small>Disetujui</small>
            <h4><?= $disetujui ?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <small>Ditolak</small>
            <h4><?= $ditolak ?></h4>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card">
    <div class="card-body">
        <h6 class="mb-3">Daftar Logbook Siswa</h6>

        <table class="table table-hover align-middle">
            <thead>
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

                    <!-- MODAL VERIFIKASI -->
                    <div class="modal fade" id="verifikasi<?= $l['id'] ?>">
                        <div class="modal-dialog">
                            <form method="post"
                                action="<?= base_url('guru/logbook/verifikasi/' . $l['id']) ?>">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6>Verifikasi Logbook</h6>
                                    </div>
                                    <div class="modal-body">
                                        <select name="status" class="form-select mb-2">
                                            <option value="disetujui">Disetujui</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                        <textarea name="catatan_guru"
                                            class="form-control"
                                            placeholder="Catatan guru..."><?= $l['catatan_guru'] ?></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
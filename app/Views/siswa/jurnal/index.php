<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>


<div class="d-flex mb-3 justify-content-between align-items-center">
    <h2 class="fw-bold">Jurnal Harian Magang</h2>
    <a href="<?= base_url('siswa/jurnal/create') ?>" class="btn btn-dudi">
        <i class="bi bi-plus-lg"></i> Tambah Jurnal
    </a>
</div>

<?php
$jamSekarang = date('H:i');
$batasMulai  = '07:00';
$batasAkhir  = '14:00';

$bolehIsi = ($jamSekarang >= $batasMulai && $jamSekarang <= $batasAkhir);
?>

<?php if (($statistik['total'] ?? 0) == 0): ?>

    <?php if ($bolehIsi): ?>
        <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <div>
                <strong>Jangan Lupa Jurnal Hari Ini!</strong><br>
                Anda belum membuat jurnal hari ini.
            </div>
            <a href="<?= base_url('siswa/jurnal/create') ?>"
                class="btn btn-warning btn-sm">
                Buat Sekarang
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            <strong>Waktu Pengisian Ditutup!</strong><br>
            Jurnal hanya bisa diisi pukul 07:00 - 18:00.
        </div>
    <?php endif; ?>

<?php endif ?>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Total Jurnal</small>
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h5 class="fw-bold"><?= $statistik['total'] ?? 0 ?></h5>
                <small>Jurnal yang telah dibuat</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Disetujui</small>
                    <i class="bi bi-check-circle text-success"></i>
                </div>
                <h5 class="fw-bold"><?= $statistik['disetujui'] ?? 0 ?></h5>
                <small>Jurnal disetujui guru</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Menunggu</small>
                    <i class="bi bi-clock text-warning"></i>
                </div>
                <h5 class="fw-bold"><?= $statistik['pending'] ?? 0 ?></h5>
                <small>Belum diverifikasi</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Ditolak</small>
                    <i class="bi bi-x-circle text-danger"></i>
                </div>
                <h5 class="fw-bold"><?= $statistik['ditolak'] ?? 0 ?></h5>
                <small>Perlu diperbaiki</small>
            </div>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card card-hero-dash">
    <div class="card-header d-flex align-items-center">
        <i class="bi bi-file-earmark-text icon-purple me-1"></i>
        <h5 class="fw-bold">Riwayat Jurnal</h5>
    </div>
    <div class="card-body pb-0 d-flex justify-content-between align-items-center">
        <div class="d-flex w-50">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="search"
                    id="searchJurnal"
                    class="form-control"
                    placeholder="Cari kegiatan atau kendala...">
            </div>
        </div>
        <div class="d-flex">
            <div class="d-flex justify-content-end me-1 mb-2">
                <label class="me-2"><i class="bi bi-funnel"></i></label>
                <select id="statusFilter" class="form-select form-select-sm" style="width:auto;">
                    <option value="">Semua status</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="menunggu">Menunggu</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-2">Tampilkan:</span>
                <select class="form-select form-select-sm me-1" style="width:auto;">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                </select>
                <span>entri</span>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light table-hover">
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan & Kendala</th>
                    <th>Status</th>
                    <th>Feedback Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="jurnalTable">
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

                        <td class="status" data-status="<?= $row['status_verifikasi'] == 'disetujui' ? 'disetujui' : ($row['status_verifikasi'] == 'ditolak' ? 'ditolak' : 'menunggu') ?>">
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
                            <button class="btn btn-sm btn-outline-primary btn-detail"
                                data-bs-toggle="modal"
                                data-id="<?= $row['id'] ?>"
                                data-tanggal="<?= date('d M Y', strtotime($row['tanggal'])) ?>"
                                data-hari="<?= date('l, d F Y', strtotime($row['tanggal'])) ?>"
                                data-status="<?= $row['status_verifikasi'] ?>"
                                data-kegiatan="<?= esc($row['kegiatan'], 'attr') ?>"
                                data-kendala="<?= esc($row['kendala'], 'attr') ?>"
                                data-file="<?= esc($row['file'], 'attr') ?>"
                                data-catatan="<?= esc($row['catatan_guru'], 'attr') ?>"
                                data-created="<?= date('d/m/Y', strtotime($row['created_at'])) ?>"
                                data-updated="<?= date('d/m/Y', strtotime($row['updated_at'])) ?>">
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
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- ================= MODAL DETAIL ================= -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <div>
                    <h5 class="modal-title mb-0">Detail Jurnal Harian</h5>
                    <small class="text-muted" id="modalHari"></small>
                </div>
                <span id="modalStatus" class="badge ms-2"></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body" id="modalBody"></div>

            <!-- FOOTER -->
            <div class="modal-footer text-muted small d-flex justify-content-between w-100">
                <span id="modalCreated"></span>
                <span id="modalUpdated"></span>
            </div>

        </div>
    </div>
</div>
<!-- ================= END MODAL ================= -->
<script>
    document.getElementById('searchJurnal').addEventListener('keyup', function() {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#jurnalTable tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>
<script>
    const statusFilter = document.getElementById('statusFilter');

    statusFilter.addEventListener('change', function() {
        const selectedStatus = this.value.toLowerCase();
        const rows = document.querySelectorAll('#jurnalTable tr');

        rows.forEach(row => {
            const status = row.querySelector('.status')?.dataset.status || '';
            row.style.display = (selectedStatus === '' || status === selectedStatus) ? '' : 'none';
        });
    });
</script>
<script>
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('detailModal');

            // Ambil data dari tombol
            const hari = this.dataset.hari;
            const status = this.dataset.status;
            const kegiatan = this.dataset.kegiatan;
            const kendala = this.dataset.kendala;
            const file = this.dataset.file;
            const catatan = this.dataset.catatan;
            const created = this.dataset.created;
            const updated = this.dataset.updated;

            // Header
            modal.querySelector('#modalHari').textContent = hari;
            const statusSpan = modal.querySelector('#modalStatus');
            statusSpan.className = 'badge ms-2';
            if (status === 'disetujui') {
                statusSpan.classList.add('bg-success');
                statusSpan.textContent = 'Disetujui';
            } else if (status === 'ditolak') {
                statusSpan.classList.add('bg-danger');
                statusSpan.textContent = 'Ditolak';
            } else {
                statusSpan.classList.add('bg-warning', 'text-dark');
                statusSpan.textContent = 'Menunggu';
            }

            // Body
            let bodyHtml = `<h6 class="fw-bold">Kegiatan Hari Ini</h6>
                        <div class="p-3 border rounded bg-light mb-3">${kegiatan.replace(/\n/g,'<br>')}</div>`;
            if (kendala) bodyHtml += `<h6 class="fw-bold">Kendala</h6>
                        <div class="p-3 border rounded bg-light mb-3">${kendala.replace(/\n/g,'<br>')}</div>`;
            if (file) bodyHtml += `<h6 class="fw-bold">Dokumentasi</h6>
                        <div class="p-3 border rounded bg-success bg-opacity-10 
                        d-flex justify-content-between align-items-center mb-3">
                        <span>${file}</span>
                        <a href="<?= base_url('uploads/jurnal/') ?>${file}" class="btn btn-success btn-sm" download>Unduh</a>
                        </div>`;
            if (catatan) bodyHtml += `<h6 class="fw-bold text-success">Catatan Guru</h6>
                        <div class="p-3 border rounded bg-success bg-opacity-10">${catatan.replace(/\n/g,'<br>')}</div>`;

            modal.querySelector('#modalBody').innerHTML = bodyHtml;

            // Footer
            modal.querySelector('#modalCreated').textContent = 'Dibuat: ' + created;
            modal.querySelector('#modalUpdated').textContent = 'Diperbarui: ' + updated;

            // Tampilkan modal pakai Bootstrap 5
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        });
    });
</script>
<?= $this->endSection() ?>
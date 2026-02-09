<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4 fw-bold">Manajemen Siswa Magang</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Total Siswa</small>
                <h3><?= $total; ?></h3>
                <small class="text-muted">Siswa magang terdaftar</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Aktif</small>
                <h3><?= $aktif; ?></h3>
                <small class="text-muted">Sedang magang</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Selesai</small>
                <h3><?= $selesai; ?></h3>
                <small class="text-muted">Magang selesai</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Pending</small>
                <h3><?= $pending; ?></h3>
                <small class="text-muted">Menunggu penempatan</small>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Daftar Siswa Magang</strong>
        <a href="<?= base_url('guru/magang/create'); ?>" class="btn btn-primary btn-sm">
            + Tambah
        </a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Siswa</th>
                    <th>Guru Pembimbing</th>
                    <th>DUDI</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($magang as $m): ?>
                    <tr>
                        <td>
                            <strong><?= $m['nama_siswa']; ?></strong><br>
                            <small class="text-muted">
                                NIS: <?= $m['nis']; ?><br>
                                <?= $m['jurusan']; ?>
                            </small>
                        </td>

                        <td>
                            <?= $m['nama_guru'] ?? '-'; ?>
                        </td>

                        <td>
                            <strong><?= $m['nama_perusahaan']; ?></strong><br>
                            <small class="text-muted"><?= $m['kota_dudi']; ?></small>
                        </td>

                        <td>
                            <small>
                                <?= date('d M Y', strtotime($m['tanggal_mulai'])); ?><br>
                                s/d <?= date('d M Y', strtotime($m['tanggal_selesai'])); ?>
                            </small>
                        </td>

                        <td>
                            <?php
                            $badge = match ($m['status']) {
                                'aktif'   => 'success',
                                'selesai' => 'primary',
                                'pending' => 'warning',
                                default   => 'secondary'
                            };
                            ?>
                            <span class="badge bg-<?= $badge; ?>">
                                <?= ucfirst($m['status']); ?>
                            </span>
                        </td>

                        <td>
                            <?= $m['nilai_akhir'] ?? '-'; ?>
                        </td>

                        <td class="text-center">
                            <a href="<?= base_url('guru/magang/edit/' . $m['id']); ?>" class="btn btn-sm btn-outline-primary">✏</a>
                            <a href="<?= base_url('guru/magang/delete/' . $m['id']); ?>"
                                onclick="return confirm('Yakin hapus data?')"
                                class="btn btn-sm btn-outline-danger">🗑</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
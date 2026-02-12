<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4 fw-bold">Manajemen Siswa Magang</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Total Siswa</small>
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="fw-bold value"><?= $total; ?></h3>
                <small class="text-muted">Siswa magang terdaftar</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Aktif</small>
                    <i class="bi bi-gear fs-5"></i>
                </div>
                <h3 class="fw-bold value"><?= $aktif ?></h3>
                <small class="text-muted">Sedang magang</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Selesai</small>
                    <i class="bi bi-check-circle"></i>
                </div>
                <h3 class="fw-bold value"><?= $selesai; ?></h3>
                <small class="text-muted">Magang selesai</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                    <small class="text-muted">Pending</small>
                    <i class="bi bi-clock"></i>
                </div>
                <h3 class="fw-bold value"><?= $pending; ?></h3>
                <small class="text-muted">Menunggu penempatan</small>
            </div>
        </div>
    </div>
</div>
<div class="card card-hero-dash">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong><i class="bi bi-gear fs-5 icon-purple"></i> Daftar Siswa Magang</strong>
        <a href="<?= base_url('guru/magang/create'); ?>" class="btn btn-dudi">
            + Tambah
        </a>
    </div>
    <div class="card-body d-flex w-50">
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>
            <input type="search"
                id="searchDudi"
                class="form-control"
                placeholder="Cari perusahaan, alamat, penanggung jawab...">
        </div>
    </div>
    <div class="card-body pb-0 d-flex justify-content-between mb-3">
        <div class="d-flex">
            <label class="me-2"><i class="bi bi-funnel"></i></label>
            <select id="roleFilter" class="form-select form-select-sm" style="width:auto;">
                <option value="">Semua role</option>
                <option value="nama_siswa">Nama</option>
                <option value="nama_perusahaan">Dudi</option>
                <option value="status">Status</option>
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

    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0 table-hover">
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
            <tbody id="dudiTable userTable">
                <?php foreach ($magang as $m): ?>
                    <tr data-role="<?= $m['status'] ?>">
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
                                'pending'      => 'warning',
                                'diterima'     => 'info',
                                'berlangsung'  => 'success',
                                'selesai'      => 'primary',
                                'ditolak'      => 'danger',
                                'dibatalkan'   => 'secondary',
                                default        => 'secondary',
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

<script>
    document.getElementById('searchDudi').addEventListener('keyup', function() {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#dudiTable tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>
<script>
    document.getElementById('roleFilter').addEventListener('change', function() {
        const selectedRole = this.value;
        const rows = document.querySelectorAll('#userTable tr');

        rows.forEach(row => {
            const role = row.getAttribute('data-role');
            if (!selectedRole || status === selectedRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>
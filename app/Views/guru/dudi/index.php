<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h4 class="fw-bold mb-4">Manajemen DUDI</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small class="text-muted">Total DUDI</small>
                        <i class="bi bi-buildings"></i>
                    </div>
                    <h3 class="fw-bold value"><?= $totalDudi ?></h3>
                    <small>Perusahaan mitra aktif</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small class="text-muted">Total Siswa Magang</small>
                        <i class="bi bi-person"></i>
                    </div>
                    <h3 class="fw-bold value"><?= $totalMagang ?></h3>
                    <small>Siswa magang aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small class="text-muted">Total Siswa Magang</small>
                        <i class="bi bi-building"></i>
                    </div>
                    <h3 class="fw-bold value"><?= $totalMagang ?></h3>
                    <small>Per perusahaan</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-hero-dash">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold"><i class="bi bi-buildings"></i> Daftar DUDI</span>
        </div>
        <div class="card-body pb-0 d-flex justify-content-between align-items-center">
            <div class="d-flex w-50">
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
            <div class="d-flex align-items-center">
                <span class="me-2">Tampilkan:</span>
                <select class="form-select form-select-sm me-1" style="width:auto;">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                </select>
                <span>per halaman</span>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Perusahaan</th>
                        <th>Kontak</th>
                        <th>Penanggung Jawab</th>
                        <th>Siswa Magang</th>
                    </tr>
                </thead>
                <tbody id="dudiTable">
                    <?php foreach ($dudi as $row): ?>
                        <tr>
                            <td>
                                <strong><?= $row['nama_perusahaan'] ?></strong><br>
                                <small class="text-muted"><?= $row['alamat'] ?></small>
                            </td>
                            <td>
                                <?= $row['email'] ?><br>
                                <small><?= $row['telepon'] ?></small>
                            </td>
                            <td><?= $row['penanggung_jawab'] ?></td>
                            <td>
                                <span class="badge bg-primary">
                                    <?= $row['total_siswa_magang']; ?> siswa
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php
            $currentPage = $pager->getCurrentPage('dudi');
            $perPage     = $pager->getPerPage('dudi');
            $total       = $pager->getTotal('dudi');

            $start = ($currentPage - 1) * $perPage + 1;
            $end   = min($start + $perPage - 1, $total);
            ?>

            <div class="d-flex justify-content-between align-items-center mt-3">

                <!-- Info ala DataTables -->
                <div class="text-muted small">
                    Menampilkan <?= $total > 0 ? $start : 0 ?>
                    – <?= $end ?>
                    dari <?= $total ?> data
                </div>

                <!-- Pagination (auto-hide) -->
                <?php if ($total > $perPage): ?>
                    <?= $pager->links('dudi', 'bootstrap_pagination') ?>
                <?php endif; ?>

            </div>

        </div>
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
<?= $this->endSection() ?>
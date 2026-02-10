<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Manajemen DUDI</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small>Total DUDI</small>
                        <i class="bi bi-buildings"></i>
                    </div>
                    <h3><?= $totalDudi ?></h3>
                    <small>Perusahaan mitra</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small>DUDI Aktif</small>
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <h3><?= $aktif ?></h3>
                    <small>Perusahaan aktif</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small>DUDI Tidak Aktif</small>
                        <i class="bi bi-patch-minus text-danger"></i>
                    </div>
                    <h3><?= $nonaktif ?></h3>
                    <small>Perusahaan tidak aktif</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                        <small>Total Siswa Magang</small>
                        <i class="bi bi-person"></i>
                    </div>
                    <h3><?= $totalMagang ?></h3>
                    <small>Siswa magang aktif</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-hero-dash">
        <!-- Header Judul + Tombol Tambah -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-buildings me-1 icon-purple"></i>Daftar DUDI</span>
            <button class="btn btn-dudi" data-bs-toggle="modal" data-bs-target="#tambah">
                + Tambah DUDI
            </button>
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
                <span>entri</span>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card-body table-responsive align-middle">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Perusahaan</th>
                        <th>Kontak</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th>Siswa Magang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dudiTable">
                    <?php foreach ($dudi as $row): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-start">
                                    <div class="me-2 icon-purple">
                                        <i class="bi bi-buildings"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?= $row['nama_perusahaan'] ?></div>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> <?= $row['alamat'] ?>
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <!-- Kontak -->
                            <td>
                                <small><i class="bi bi-envelope"></i> <?= $row['email'] ?></small><br>
                                <small class="text-muted"><i class="bi bi-telephone"></i> <?= $row['telepon'] ?></small>
                            </td>

                            <!-- Penanggung Jawab -->
                            <td>
                                <div class="d-flex align-items-start">
                                    <div class="me-2 icon-person">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <small><?= $row['penanggung_jawab'] ?></small>
                                    </div>
                                </div>
                            </td>

                            <!-- Status -->
                            <td>
                                <span class="badge 
                    <?= $row['status'] == 'aktif' ? 'bg-success' : ($row['status'] == 'pending' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>

                            <!-- Siswa Magang -->
                            <td>
                                <span class="badge badge-primary">
                                    <?= $row['total_siswa_magang']; ?> siswa
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td>
                                <a href="#" class="text-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('admin/dudi/delete/' . $row['id']) ?>"
                                    class="text-danger delete-btn"
                                    data-id="<?= $row['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
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
<?php foreach ($dudi as $row): ?>
    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" action="<?= base_url('admin/dudi/update/' . $row['id']) ?>" class="card-hero-dash modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit DUDI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Perusahaan</label>
                        <input name="nama_perusahaan" class="form-control" value="<?= $row['nama_perusahaan'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"><?= $row['alamat'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" value="<?= $row['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input name="telepon" class="form-control" value="<?= $row['telepon'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penanggung Jawab</label>
                        <input name="penanggung_jawab" class="form-control" value="<?= $row['penanggung_jawab'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="aktif" <?= $row['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= $row['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<div class="modal fade" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="post" action="<?= base_url('admin/dudi/store') ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah DUDI Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Nama Perusahaan -->
                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan *</label>
                    <input name="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" required>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label class="form-label">Alamat *</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <!-- Telepon -->
                <div class="mb-3">
                    <label class="form-label">Telepon *</label>
                    <input name="telepon" class="form-control" placeholder="Contoh: 021-12345678" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input name="email" type="email" class="form-control" placeholder="Contoh: info@perusahaan.com" required>
                </div>

                <!-- Penanggung Jawab -->
                <div class="mb-3">
                    <label class="form-label">Penanggung Jawab *</label>
                    <input name="penanggung_jawab" class="form-control" placeholder="Nama penanggung jawab" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" selected>Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div id="confirmBox" class="confirm-box">
    <div class="confirm-content">
        <h5>Konfirmasi Hapus</h5>
        <p>Apakah Anda yakin ingin menghapus data user ini?<br>
            <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
        </p>
        <div class="text-end">
            <button id="cancelBtn" class="btn btn-secondary btn-sm">Batal</button>
            <button id="confirmBtn" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBox = document.getElementById('confirmBox');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        let deleteUrl = '';

        // Tangkap klik tombol hapus
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                deleteUrl = this.getAttribute('href');
                confirmBox.style.display = 'block';
            });
        });

        // Tombol batal
        cancelBtn.addEventListener('click', function() {
            confirmBox.style.display = 'none';
            deleteUrl = '';
        });

        // Tombol konfirmasi hapus
        confirmBtn.addEventListener('click', function() {
            if (deleteUrl) {
                window.location.href = deleteUrl;
            }
        });
    });
</script>

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
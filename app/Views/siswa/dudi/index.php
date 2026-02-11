<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<section id="dudi-siswa" class="container my-4">
    <h2 class="mb-4">Cari Tempat Magang</h2>

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($dudiList)): ?>
        <?php foreach ($dudiList as $dudi): ?>

            <?php
            $status = $statusMagang[$dudi['id']] ?? null;
            ?>

            <div class="card mb-3 shadow-sm">
                <div class="card-body">

                    <h5 class="card-title">
                        <?= esc($dudi['nama_perusahaan']) ?>
                    </h5>

                    <p class="card-subtitle text-muted mb-2">
                        <?= esc($dudi['bidang'] ?? 'Umum') ?>
                    </p>

                    <!-- BADGE STATUS -->
                    <?php if ($status): ?>
                        <?php if ($status == 'pending'): ?>
                            <span class="badge bg-warning text-dark mb-2">
                                Menunggu Verifikasi
                            </span>
                        <?php elseif ($status == 'disetujui'): ?>
                            <span class="badge bg-success mb-2">
                                Diterima
                            </span>
                        <?php elseif ($status == 'ditolak'): ?>
                            <span class="badge bg-danger mb-2">
                                Ditolak
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <p class="mt-2">
                        <strong>Alamat:</strong> <?= esc($dudi['alamat']) ?><br>
                        <strong>PIC:</strong> <?= esc($dudi['penanggung_jawab']) ?>
                    </p>

                    <!-- PROGRESS KUOTA -->
                    <?php
                    $kuota = $dudi['kuota'] ?? 0;
                    $terisi = $dudi['kuota_terisi'] ?? 0;
                    $percent = $kuota > 0 ? ($terisi / $kuota) * 100 : 0;
                    $sisa = $kuota - $terisi;
                    ?>

                    <p>
                        <strong>Kuota:</strong> <?= $terisi ?>/<?= $kuota ?>
                        (<?= $sisa ?> slot tersisa)
                    </p>

                    <div class="progress mb-3">
                        <div class="progress-bar 
                            <?= $status ? 'bg-secondary' : 'bg-success' ?>"
                            style="width: <?= $percent ?>%;">
                            <?= $terisi ?>/<?= $kuota ?>
                        </div>
                    </div>

                    <p class="card-text">
                        <?= esc($dudi['deskripsi'] ?? '-') ?>
                    </p>

                    <!-- BUTTONS -->
                    <button
                        class="btn btn-outline-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalDudi<?= $dudi['id'] ?>">
                        Detail
                    </button>

                    <?php if (!$status): ?>

                        <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                            class="btn btn-success btn-sm">
                            Daftar
                        </a>

                    <?php elseif ($status == 'ditolak'): ?>

                        <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                            class="btn btn-primary btn-sm">
                            Daftar Ulang
                        </a>

                    <?php else: ?>

                        <button class="btn btn-secondary btn-sm" disabled>
                            Sudah Mendaftar
                        </button>

                    <?php endif; ?>

                </div>
            </div>

            <!-- MODAL DETAIL -->
            <div class="modal fade" id="modalDudi<?= $dudi['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title">
                                    <?= esc($dudi['nama_perusahaan']) ?>
                                </h5>
                                <small class="text-muted">
                                    <?= esc($dudi['bidang'] ?? 'Umum') ?>
                                </small>
                            </div>

                            <?php if ($status): ?>
                                <?php if ($status == 'pending'): ?>
                                    <span class="badge bg-warning text-dark">
                                        Menunggu Verifikasi
                                    </span>
                                <?php elseif ($status == 'disetujui'): ?>
                                    <span class="badge bg-success">
                                        Diterima
                                    </span>
                                <?php elseif ($status == 'ditolak'): ?>
                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <h6>Tentang Perusahaan</h6>
                            <p class="text-muted">
                                <?= esc($dudi['deskripsi'] ?? '-') ?>
                            </p>

                            <hr>

                            <h6>Informasi Kontak</h6>
                            <p>
                                <strong>Alamat:</strong><br>
                                <?= esc($dudi['alamat']) ?><br><br>

                                <strong>Penanggung Jawab:</strong><br>
                                <?= esc($dudi['penanggung_jawab']) ?><br><br>

                                <strong>Telepon:</strong><br>
                                <?= esc($dudi['telepon']) ?><br><br>

                                <strong>Email:</strong><br>
                                <?= esc($dudi['email']) ?>
                            </p>

                        </div>

                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">
                                Tutup
                            </button>

                            <?php if (!$status): ?>

                                <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                                    class="btn btn-primary">
                                    Daftar Magang
                                </a>

                            <?php elseif ($status == 'ditolak'): ?>

                                <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                                    class="btn btn-primary">
                                    Daftar Ulang
                                </a>

                            <?php else: ?>

                                <button class="btn btn-secondary" disabled>
                                    Sudah Mendaftar
                                </button>

                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    <?php else: ?>
        <p class="text-muted">Belum ada DUDI tersedia.</p>
    <?php endif; ?>

    <div class="text-muted mt-3">
        Menampilkan <?= count($dudiList) ?> perusahaan
    </div>

</section>

<?= $this->endSection() ?>
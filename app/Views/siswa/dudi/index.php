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

    <div class="row g-4">
        <?php if (!empty($dudiList)): ?>
            <?php foreach ($dudiList as $dudi): ?>

                <?php
                $status = $statusMagang[$dudi['id']] ?? null;

                $kuota   = $dudi['kuota'] ?? 0;
                $terisi  = $dudi['kuota_terisi'] ?? 0;
                $percent = $kuota > 0 ? ($terisi / $kuota) * 100 : 0;
                $sisa    = $kuota - $terisi;

                /* Warna status */
                $badgeClass = match ($status) {
                    'pending'   => 'bg-warning text-dark',
                    'disetujui' => 'bg-success',
                    'ditolak'   => 'bg-danger',
                    default     => ''
                };

                $statusText = match ($status) {
                    'pending'   => 'Menunggu',
                    'disetujui' => 'Diterima',
                    'ditolak'   => 'Ditolak',
                    default     => ''
                };
                ?>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body d-flex flex-column">

                            <!-- HEADER -->
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width:50px;height:50px;">
                                    <i class="bi bi-building"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">
                                        <?= esc($dudi['nama_perusahaan']) ?>
                                    </h6>
                                    <small class="text-success fw-semibold">
                                        <?= esc($dudi['bidang'] ?? 'Umum') ?>
                                    </small>

                                    <?php if ($status): ?>
                                        <div class="mt-2">
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= $statusText ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- INFO -->
                            <div class="small text-muted mb-3">
                                <div><i class="bi bi-geo-alt me-1"></i> <?= esc($dudi['alamat']) ?></div>
                                <div><i class="bi bi-person me-1"></i> PIC: <?= esc($dudi['penanggung_jawab']) ?></div>
                            </div>

                            <!-- KUOTA -->
                            <div class="small fw-semibold mb-1">
                                Kuota
                                <span class="float-end"><?= $terisi ?>/<?= $kuota ?></span>
                            </div>

                            <div class="progress mb-2" style="height:6px;">
                                <div class="progress-bar"
                                    role="progressbar"
                                    style="width: <?= $percent ?>%">
                                </div>
                            </div>

                            <div class="small text-muted mb-3">
                                <?= $sisa ?> slot tersisa
                            </div>

                            <!-- DESKRIPSI -->
                            <p class="text-muted small flex-grow-1">
                                <?= esc($dudi['deskripsi'] ?? '-') ?>
                            </p>

                            <!-- BUTTON -->
                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <button class="btn btn-light btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDudi<?= $dudi['id'] ?>">
                                    <i class="bi bi-eye"></i> Detail
                                </button>

                                <?php if (!$status): ?>
                                    <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                                        class="btn btn-primary btn-sm">
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
                    </div>
                </div>


                <!-- MODAL DETAIL -->
                <div class="modal fade" id="modalDudi<?= $dudi['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title mb-0">
                                        <?= esc($dudi['nama_perusahaan']) ?>
                                    </h5>
                                    <small class="text-muted">
                                        <?= esc($dudi['bidang'] ?? 'Umum') ?>
                                    </small>
                                </div>

                                <?php if ($status): ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                <?php endif; ?>

                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <h6 class="fw-bold">Tentang Perusahaan</h6>
                                <p class="text-muted">
                                    <?= esc($dudi['deskripsi'] ?? '-') ?>
                                </p>

                                <hr>

                                <h6 class="fw-bold">Informasi Kontak</h6>
                                <p class="mb-1"><strong>Alamat:</strong><br><?= esc($dudi['alamat']) ?></p>
                                <p class="mb-1"><strong>PIC:</strong><br><?= esc($dudi['penanggung_jawab']) ?></p>
                                <p class="mb-1"><strong>Telepon:</strong><br><?= esc($dudi['telepon']) ?></p>
                                <p><strong>Email:</strong><br><?= esc($dudi['email']) ?></p>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-light"
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
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada DUDI tersedia.
                </div>
            </div>
        <?php endif; ?>
    </div>

</section>

<?= $this->endSection() ?>
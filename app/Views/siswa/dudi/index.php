<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>
<section id="dudi-siswa" class="container my-4">
    <h2 class="mb-4">Cari Tempat Magang</h2>

    <?php if (!empty($dudiList)): ?>
        <?php foreach ($dudiList as $dudi): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($dudi['nama_perusahaan']) ?></h5>
                    <p class="card-subtitle text-muted"><?= esc($dudi['bidang'] ?? 'Umum') ?></p>
                    <p class="mt-2">
                        <strong>Alamat:</strong> <?= esc($dudi['alamat']) ?> <br>
                        <strong>PIC:</strong> <?= esc($dudi['penanggung_jawab']) ?>
                    </p>
                    <p><strong>Kuota Magang:</strong> <?= esc($dudi['kuota_terisi'] ?? 0) ?>/<?= esc($dudi['kuota'] ?? 0) ?>
                        (<?= (isset($dudi['kuota']) && isset($dudi['kuota_terisi'])) ? esc($dudi['kuota'] - $dudi['kuota_terisi']) : 0 ?> slot tersisa)</p>

                    <div class="progress mb-3">
                        <?php
                        $percent = 0;
                        if (isset($dudi['kuota']) && isset($dudi['kuota_terisi']) && $dudi['kuota'] > 0) {
                            $percent = ($dudi['kuota_terisi'] / $dudi['kuota']) * 100;
                        }
                        ?>
                        <div class="progress-bar <?= in_array($dudi['id'], $daftarSiswa) ? 'bg-secondary' : 'bg-success' ?>"
                            style="width: <?= $percent ?>%;">
                            <?= $dudi['kuota_terisi'] ?? 0 ?>/<?= $dudi['kuota'] ?? 0 ?>
                        </div>
                    </div>

                    <p class="card-text">
                        <?= esc($dudi['deskripsi'] ?? '-') ?>
                    </p>

                    <!-- Tombol aksi -->
                    <a href="<?= base_url('/siswa/dudi/detail/' . $dudi['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                    <?php if (in_array($dudi['id'], $daftarSiswa)): ?>
                        <a href="#" class="btn btn-secondary btn-sm disabled">Sudah Mendaftar</a>
                    <?php else: ?>
                        <a href="<?= base_url('/siswa/dudi/daftar/' . $dudi['id']) ?>" class="btn btn-success btn-sm">Daftar</a>
                    <?php endif; ?>
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
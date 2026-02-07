<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <small class="text-muted">Selamat datang di sistem pelaporan magang</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Total Siswa</small>
            <h3 class="fw-bold value"><?= $totalSiswa ?></h3>
            <small>Seluruh siswa terdaftar</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">DUDI Partner</small>
            <h3 class="fw-bold value"><?= $totalDudi ?></h3>
            <small>Perusahaan mitra</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Siswa Magang</small>
            <h3 class="fw-bold value"><?= $totalMagang ?></h3>
            <small>Sedang aktif magang</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Logbook Hari Ini</small>
            <h3 class="fw-bold value"><?= $totalLogbook ?></h3>
            <small>Laporan masuk</small>
        </div>
    </div>
</div>

<div class="row g-4">

    <!-- MAGANG TERBARU -->
    <div class="col-md-6">
        <div class="card card-stat p-3">
            <h6 class="fw-bold mb-3">Magang Terbaru</h6>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <strong>Ahmad Rizki</strong><br>
                    <small class="text-muted">PT. Teknologi Nusantara</small>
                </div>
                <span class="badge bg-success badge-status">Aktif</span>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>Siti Nurhaliza</strong><br>
                    <small class="text-muted">CV. Digital Kreativa</small>
                </div>
                <span class="badge bg-success badge-status">Aktif</span>
            </div>
        </div>
    </div>

    <!-- DUDI AKTIF -->
    <div class="col-md-6">
        <div class="card card-stat p-3">
            <h6 class="fw-bold mb-3">DUDI Aktif</h6>

            <div class="mb-2">
                <strong>PT. Teknologi Nusantara</strong><br>
                <small class="text-muted">Surabaya</small>
                <span class="badge bg-primary float-end">8 siswa</span>
            </div>

            <div class="mb-2">
                <strong>CV. Digital Kreativa</strong><br>
                <small class="text-muted">Surabaya</small>
                <span class="badge bg-primary float-end">5 siswa</span>
            </div>

            <div>
                <strong>PT. Inovasi Mandiri</strong><br>
                <small class="text-muted">Surabaya</small>
                <span class="badge bg-primary float-end">12 siswa</span>
            </div>
        </div>
    </div>

    <!-- LOGBOOK -->
    <div class="col-12">
        <div class="card card-stat p-3">
            <h6 class="fw-bold mb-3">Logbook Terbaru</h6>

            <div class="mb-2">
                <strong>Memperbarui sistem database</strong><br>
                <small class="text-muted">Disetujui</small>
                <span class="badge bg-success float-end">Disetujui</span>
            </div>

            <div class="mb-2">
                <strong>Membuat desain mockup website</strong><br>
                <small class="text-muted">Menunggu</small>
                <span class="badge bg-warning float-end">Pending</span>
            </div>

            <div>
                <strong>Training keamanan sistem</strong><br>
                <small class="text-muted">Ditolak</small>
                <span class="badge bg-danger float-end">Ditolak</span>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
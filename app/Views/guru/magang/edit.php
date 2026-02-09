<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Manajemen Edit</h4>

<form action="<?= base_url('guru/magang/update/' . $magang['id']); ?>" method="post">
    <?= csrf_field(); ?>

    <div class="row g-3">

        <div class="col-md-6">
            <label>Siswa</label>
            <select name="siswa_id" class="form-select" required>
                <?php foreach ($siswa as $s): ?>
                    <option value="<?= $s['id']; ?>"
                        <?= $magang['siswa_id'] == $s['id'] ? 'selected' : ''; ?>>
                        <?= $s['nama']; ?> (<?= $s['nis']; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>DUDI</label>
            <select name="dudi_id" class="form-select" required>
                <?php foreach ($dudi as $d): ?>
                    <option value="<?= $d['id']; ?>"
                        <?= $magang['dudi_id'] == $d['id'] ? 'selected' : ''; ?>>
                        <?= $d['nama_perusahaan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>Guru Pembimbing</label>
            <select name="guru_id" class="form-select">
                <?php foreach ($guru as $g): ?>
                    <option value="<?= $g['id']; ?>"
                        <?= $magang['guru_id'] == $g['id'] ? 'selected' : ''; ?>>
                        <?= $g['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>Status</label>
            <select name="status" class="form-select">
                <?php foreach (['pending', 'aktif', 'selesai'] as $st): ?>
                    <option value="<?= $st; ?>"
                        <?= $magang['status'] == $st ? 'selected' : ''; ?>>
                        <?= ucfirst($st); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control"
                value="<?= $magang['tanggal_mulai']; ?>" required>
        </div>

        <div class="col-md-6">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control"
                value="<?= $magang['tanggal_selesai']; ?>" required>
        </div>

        <div class="col-md-6">
            <label>Nilai Akhir</label>
            <input type="number" name="nilai_akhir" class="form-control"
                value="<?= $magang['nilai_akhir']; ?>">
        </div>

    </div>

    <div class="mt-4">
        <button class="btn btn-primary">Update</button>
        <a href="<?= base_url('guru/magang'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</form>

<?= $this->endSection() ?>
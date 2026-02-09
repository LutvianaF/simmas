<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Manajemen Tambah</h4>

<form action="<?= base_url('guru/magang/store'); ?>" method="post">
    <?= csrf_field(); ?>

    <div class="row g-3">

        <div class="col-md-6">
            <label>Siswa</label>
            <select name="siswa_id" class="form-select" required>
                <option value="">-- Pilih Siswa --</option>
                <?php foreach ($siswa as $s): ?>
                    <option value="<?= $s['id']; ?>">
                        <?= $s['nama']; ?> (<?= $s['nis']; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>DUDI</label>
            <select name="dudi_id" class="form-select" required>
                <option value="">-- Pilih DUDI --</option>
                <?php foreach ($dudi as $d): ?>
                    <option value="<?= $d['id']; ?>">
                        <?= $d['nama_perusahaan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>Guru Pembimbing</label>
            <select name="guru_id" class="form-select">
                <option value="">-- Pilih Guru --</option>
                <?php foreach ($guru as $g): ?>
                    <option value="<?= $g['id']; ?>">
                        <?= $g['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

    </div>

    <div class="mt-4">
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('guru/magang'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</form>

<?= $this->endSection() ?>
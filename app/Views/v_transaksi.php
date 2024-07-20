<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
                <a type="button" class="btn btn-success" href="<?=base_url() ?>transaksi/download">
                    Download data
                </a>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Alamat</th>
            <th scope="col">Ongkir</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaction as $transaction): ?>
            <tr>
                <th scope="row"><?= $transaction['id'] ?></th>
                <td><?= $transaction['username'] ?></td>
                <td><?= $transaction['total_harga'] ?></td>
                <td><?= $transaction['alamat'] ?></td>
                <td><?= $transaction['ongkir'] ?></td>
                <td>
                    <?php if ($transaction['status'] == 1): ?>
                        1
                    <?php else: ?>
                        0
                    <?php endif; ?>
                </td>
                <td>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $transaction['id'] ?>">
                    Ubah
                </button>
                </td>
            </tr>
            <!-- Edit Modal Begin -->
            <div class="modal fade" id="editModal-<?= $transaction['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <form action="<?= base_url('transaksi/edit/' . $transaction['id']) ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                            <input type="number" name="status" class="form-control" id="status" value="<?= $transaction['status'] ?>" min="0" max="1" required>
                            <small class="form-text text-muted">Transaksi harus berupa angka 0 atau 1.</small>
                        </div>
                    </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Edit Modal End -->
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
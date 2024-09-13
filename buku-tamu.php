<?php
include_once('templates/header.php');
require_once('function.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku Tamu</h1>

    <?php
    if (isset($_POST['simpan'])) {
        if (tambah_tamu($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data berhasil disimpan!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal disimpan
            </div>
    <?php
        }
    }
    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Data Tamu</span>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>No/ Telp/HP</th>
                            <th>Bertemu Dengan</th>
                            <th>Kepentingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $buku_tamu = query("SELECT * FROM tabel_buku_tamu");
                        foreach ($buku_tamu as $tamu) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $tamu['tanggal'] ?></td>
                                <td><?= $tamu['nama_tamu'] ?></td>
                                <td><?= $tamu['alamat'] ?></td>
                                <td><?= $tamu['no_hp'] ?></td>
                                <td><?= $tamu['bertemu'] ?></td>
                                <td><?= $tamu['kepentingan'] ?></td>
                                <td>
                                    <a class="btn btn-success" href="edit-tamu.php?id=<?= $tamu['id_tamu'] ?>">Ubah</a>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"
                                    href="hapus-tamu.php?id=<?= $tamu['id_tamu'] ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$query = mysqli_query($koneksi, "SELECT max(id_tamu) as kodeTerbesar FROM tabel_buku_tamu");
$data = mysqli_fetch_array($query);
$kodeTamu = $data['kodeTerbesar'];

$kodeTamu = isset($kodeTamu) ? $kodeTamu : ''; // Ensure it's not null
$urutan = (int) substr($kodeTamu, 2, 3);

$urutan++;

$huruf = "zt";
$kodeTamu = $huruf . sprintf("%03s", $urutan);
?>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Model Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_tamu" id="id_tamu" value="<?= $kodeTamu ?>">
                    <div class="form-group row">
                        <label for="nama_tamu" class="col-sm-3 col-form-label">Nama Tamu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_tamu" name="nama_tamu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bertemu" class="col-sm-3 col-form-label">Bertemu dg.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bertemu" name="bertemu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kepentingan" class="col-sm-3 col-form-label">Kepentingan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kepentingan" name="kepentingan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php')
?>
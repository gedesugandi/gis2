<?php require('koneksi.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Kelola Data</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-light bg-info ">
            <span class="navbar-brand mb-0 h1 text-white">Pemetaan Data Penduduk Wilayah Denpasar</span>
          </nav>
        </div>
      </div>  
      <div class="row">
        <div class="col-12">
          <div class="card bg-light mb-3" >
            <div class="card-header">Kelola Data</div>
            <div class="card-body">
              <a href="index.php" class="btn btn-info">< Kembali</a>
              <?php 
                session_start();
                if(isset($_SESSION['status'])){
                  if ($_SESSION['status'] == 'berhasil') {
                    echo '<div class="alert alert-success" role="alert">';
                    echo "Data Berhasil Disimpan";
                    echo '</div>';
                  }else{
                    echo '<div class="alert alert-danger" role="alert">';
                    echo "Gagal, Terjadi Kesalahan";
                    echo '</div>';
                  }
                  unset($_SESSION['status']);
                }
               ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                 $query_modal = mysqli_query($db,"SELECT tbl_data_kecamatan.*,tbl_kecamatan.* FROM tbl_data_kecamatan INNER JOIN tbl_kecamatan ON tbl_data_kecamatan.id_kecamatan = tbl_kecamatan.id_kecamatan");
                 $no = 1;
                 while ($data = mysqli_fetch_array($query_modal)) {
                   ?>
                  <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= ucfirst($data['nama_kecamatan']) ?></td>
                    <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#modals<?= $data['id_data'] ?>">Edit Data</a></td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="modals<?= $data['id_data'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form action="save.php?action=saveEdit" method="post" name="save">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data <?= ucfirst($data['nama_kecamatan']) ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <input type="hidden" name="id_data" value="<?= $data['id_data'] ?>">
                              <div class="form-group">
                                <label for="luas_wilayah">Luas Wilayah</label>
                                <input type="text" class="form-control" name="luas_wilayah" id="luas_wilayah" placeholder="Luas Wilayah" value="<?= $data['luas_wilayah'] ?>" required="true">
                              </div>
                              <div class="form-group">
                                <label for="jml_laki">Jumlah Laki</label>
                                <input type="text" class="form-control" name="jml_laki" id="jml_laki" placeholder="Jumlah Laki-laki" value="<?= $data['jml_laki'] ?>" required="true">
                              </div>
                              <div class="form-group">
                                <label for="jml_perempuan">Jumlah Perempuan</label>
                                <input type="text" class="form-control" name="jml_perempuan" id="jml_perempuan" placeholder="Jumlah Perempuan" value="<?= $data['jml_perempuan'] ?>" required="true">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" style="margin-top: 30px;">
            <div class="col-12">
              <nav class="navbar navbar-light bg-info text-center">
                <span class="navbar-brand mb-0 h1 text-white">&copy; 2020 Sumber data: bps.denpasarkota.go.id </span>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/dist/js/bootstrap.min.js"></script>

</html>
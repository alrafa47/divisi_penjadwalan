<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data sesi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data sesi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_sesi')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_sesi');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data sesi</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="<?= base_url('Sesi/tambahData') ?>" method="post">
                  <div class="form-group">
                    <label for="kode_sesi">Kode Sesi</label>
                    <input type="text" name="kode_sesi" class="form-control" id="kode_sesi">
                    <small class="form-text text-danger"><?= form_error('kode_sesi'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" id="jam_mulai">
                    <small class="form-text text-danger"><?= form_error('jam_mulai'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" id="jam_selesai">
                    <small class="form-text text-danger"><?= form_error('jam_selesai'); ?></small>
                  </div>

                  <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>kode Sesi</th>
                  <th>Jam Mulai</th>
                  <th>jam Selesai</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sesi as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->KODE_SESI; ?></td>
                    <td><?= $row->JAM_MULAI; ?></td>
                    <td><?= $row->JAM_SELESAI; ?></td>
                    <td>
                      <a href=<?= base_url("Sesi/deleteData/$row->KODE_SESI"); ?> class="btn btn-danger float-right tombol-hapus">hapus</a>
                      <a href=<?= base_url("Sesi/ubah/$row->KODE_SESI"); ?> class="btn btn-success float-right">ubah</a>
                    </td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper
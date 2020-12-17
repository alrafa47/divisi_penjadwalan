<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Sesi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Sesi</li>
            <li class="breadcrumb-item active">Ubah Data Sesi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <form action="<?= base_url('Sesi/updateData') ?>" method="post">
                  <input type="hidden" name="kode_sesi" value="<?= $sesi->KODE_SESI; ?>">
                  <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" value="<?= $sesi->JAM_MULAI; ?>">
                    <small class="form-text text-danger"><?= form_error('jam_mulai'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" value="<?= $sesi->JAM_SELESAI; ?>">
                    <small class="form-text text-danger"><?= form_error('jam_selesai'); ?></small>
                  </div>
                  <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
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
  </section>
  <!-- /.content -->
</div>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Mapel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Mapel</li>
            <li class="breadcrumb-item active">Ubah Data Mapel</li>
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
              <div class="col-md-12">
                <form action="<?= base_url('Mapel/updateData') ?>" method="post">
                  <input type="text" name="kode_mapel" value="<?= $mapel->KODE_MAPEL; ?>">
                  <div class="form-group">
                    <label for="nama_mapel">Nama</label>
                    <input type="text" name="nama_mapel" class="form-control" id="nama_mapel" value="<?= $mapel->NAMA_MAPEL; ?>">
                    <small class="form-text text-danger"><?= form_error('nama_mapel'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="kode_jurusan">Jurusan</label>
                    <select class="form-control" id="kode_jurusan" name="kode_jurusan">
                      <?php
                      foreach ($jurusan as $j) : ?>
                        <?php if ($j['KODE_JURUSAN'] == $mapel->KODE_JURUSAN) : ?>
                          <option value="<?= $j['KODE_JURUSAN']; ?>" selected><?= $j['NAMA_JURUSAN']; ?></option>
                        <?php else : ?>
                          <option value="<?= $j['KODE_JURUSAN']; ?>"><?= $j['NAMA_JURUSAN']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status_mapel">Jurusan</label>
                    <select class="form-control" id="status_mapel" name="status_mapel">
                      <?php
                      $status = ['Produktif', 'Non Produktif'];
                      foreach ($status as $s) : ?>
                        <?php if ($s == $mapel->STATUS_MAPEL) : ?>
                          <option value="<?= $s; ?>" selected><?= $s; ?></option>
                        <?php else : ?>
                          <option value="<?= $s; ?>"><?= $s; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
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
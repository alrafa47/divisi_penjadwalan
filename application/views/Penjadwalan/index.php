<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data jadwal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data jadwal</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_jadwal')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jadwal');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data Pengajaran</h5>
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
                <form action="<?= base_url('Penjadwalan/tambahData') ?>" method="post">
                  <div class="form-group">
                    <label for="kode_jurusan">Jurusan</label>
                    <select class="form-control" id="kode_jurusan" name="kode_jurusan">
                      <option value="-">Pilih Jurusan</option>
                      <?php foreach ($jurusan as $rowJurusan) : ?>
                        <option value="<?= $rowJurusan['KODE_JURUSAN'] ?>"><?= $rowJurusan['NAMA_JURUSAN'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_kelas">Kelas</label>
                    <select class="form-control" id="kode_kelas" name="kode_kelas" disabled>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_mapel">Mata Pelajaran</label>
                    <select class="form-control" id="kode_mapel" name="kode_mapel" disabled>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_guru">Guru</label>
                    <select class="form-control" id="kode_guru" name="kode_guru" disabled>
                      <option value="-">pilih guru</option>
                      <?php foreach ($guru as $rowGuru) : ?>
                        <option value="<?= $rowGuru['NIG'] ?>"><?= $rowGuru['NAMA_GURU'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div id="lihat-jadwal" class="btn btn-primary float-right disabled">Lihat Jadwal</div>
                  <br>
                  <h3>Ploting Jadwal</h3>
                  <h4 id="data-jadwal">-</h4>
                  <div id="table-jadwal"></div>
                  <button type="submit" id="btn-plottin" class="btn btn-success float-right disabled">Plotiing Jadwal</button>
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
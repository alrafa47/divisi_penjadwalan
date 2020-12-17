<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data mapel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data mapel</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_mapel')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_mapel');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data mapel</h5>
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
                <form action="<?= base_url('Mapel/tambahData') ?>" method="post">
                  <div class="form-group">
                    <label for="kode_mapel">Kode Mapel</label>
                    <input type="text" name="kode_mapel" class="form-control" id="kode_mapel">
                    <small class="form-text text-danger"><?= form_error('kode_mapel'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="nama_mapel">Nama Mapel</label>
                    <input type="text" name="nama_mapel" class="form-control" id="nama_mapel">
                    <small class="form-text text-danger"><?= form_error('nama_mapel'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="kode_jurusan">Jurusan</label>
                    <select class="form-control" id="kode_jurusan" name="kode_jurusan">
                      <?php foreach ($jurusan as $rowJurusan) : ?>
                        <option value="<?= $rowJurusan['KODE_JURUSAN'] ?>"><?= $rowJurusan['NAMA_JURUSAN'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status_mapel">Kelompok Mapel</label>
                    <select class="form-control" id="status_mapel" name="status_mapel">
                      <option value="Non Produktif">Non Produktif</option>
                      <option value="Produktif">Produktif</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label> <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="X" name="kelas[]" value="X">
                      <label class="form-check-label" for="X">X</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="XI" name="kelas[]" value="XI">
                      <label class="form-check-label" for="XI">XI</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="XII" name="kelas[]" value="XII">
                      <label class="form-check-label" for="XII">XII</label>
                    </div>
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
                  <th>Kode Mapel</th>
                  <th>Mata Pelajaran</th>
                  <th>Jurusan</th>
                  <th>Status Mapel</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($mapel as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->KODE_MAPEL; ?></td>
                    <td><?= $row->NAMA_MAPEL; ?></td>
                    <td><?= $jurusan[array_search($row->KODE_JURUSAN, array_column($jurusan, 'KODE_JURUSAN'))]['NAMA_JURUSAN'] ?></td>
                    <td><?= $row->STATUS_MAPEL; ?></td>
                    <td>
                      <a href="<?= base_url('Mapel/deleteData/'); ?><?= $row->KODE_MAPEL; ?>" class="btn btn-danger float-right tombol-hapus">hapus</a>
                      <a href="<?= base_url('Mapel/ubah/'); ?><?= $row->KODE_MAPEL; ?>" class="btn btn-success float-right">ubah</a>
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
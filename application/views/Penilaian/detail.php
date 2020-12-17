<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Penilaian</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tambah Data penilaian</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mapel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($mapel as $rowMapel) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $rowMapel->NAMA_MAPEL ?></td>
                                        <td>
                                            <a href='<?= base_url("Penilaian/tableNilai/$rowMapel->KODE_KELAS/$rowMapel->KODE_JADWAL") ?>' class='btn btn-danger'>Nilai Siswa</a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tambah Data penilaian</h5>
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
                                <form>
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
                                    <div id="lihat-mapel" class="btn btn-primary float-right">Lihat Mapel</div>
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
    </section>
    <!-- /.content -->
</div>
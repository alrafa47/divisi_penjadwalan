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
                        <li class="breadcrumb-item active">TES</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <?php if ($this->session->flashdata('flash_penilaian')) { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6>
                <strong>
                    <?= $this->session->flashdata('flash_penilaian');   ?>
                </strong>
            </h6>
        </div>
    <?php } ?>
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
                        <?php
                        $kodeJadwal = $this->uri->segment(4);
                        $kodeKelas = $this->uri->segment(3);
                        ?>
                        <form action="<?= base_url('Penilaian/tambahData/' . $kodeKelas . '/' . $kodeJadwal) ?>" method="post">
                            <table id='example1' class='table table-bordered table-striped table-responsive'>
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Ulangan 1</th>
                                        <th>Ulangan 2</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>NILAI AKHIR</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $kode_jadwal = $this->uri->segment(4);

                                    foreach ($siswa as $rowSiswa) {
                                    ?>
                                        <tr>
                                            <td><?= $rowSiswa['NIS'] ?><input style="width: 150px;" class="form-control" type="hidden" value="<?= $rowSiswa['NIS'] ?>" name="nis[]" id="NIS"></td>
                                            <td><?= $rowSiswa['NAMA_SISWA'] ?></td>
                                            <?php
                                            $data = array_search($rowSiswa['NIS'], array_column($penilaian, 'NIS'));
                                            $uh1 = 0;
                                            $uh2 = 0;
                                            $uts = 0;
                                            $uas = 0;
                                            $na = 0;
                                            $input = '';
                                            if (is_int($data)) {
                                                $uh1 = $penilaian[$data]->ULANGAN1;
                                                $uh2 = $penilaian[$data]->ULANGAN2;
                                                $uts = $penilaian[$data]->UTS;
                                                $uas = $penilaian[$data]->UAS;
                                                $na = $penilaian[$data]->NILAI_AKHIR;
                                                $input = 'disabled';
                                            }
                                            ?>
                                            <td>
                                                <input style="width: 150px;" class="form-control <?= $rowSiswa['NIS'] ?>" value="<?= $uh1 ?>" type="number" name="uh1[]" id="uh1" min="0" max="100" <?= $input ?>>
                                            </td>
                                            <td>
                                                <input style="width: 150px;" class="form-control <?= $rowSiswa['NIS'] ?>" value="<?= $uh2 ?>" type="number" name="uh2[]" id="uh2" min="0" max="100" <?= $input ?>>
                                            </td>
                                            <td>
                                                <input style="width: 150px;" class="form-control <?= $rowSiswa['NIS'] ?>" value="<?= $uts ?>" type="number" name="uts[]" id="uts" min="0" max="100" <?= $input ?>>
                                            </td>
                                            <td>
                                                <input style="width: 150px;" class="form-control <?= $rowSiswa['NIS'] ?>" value="<?= $uas ?>" type="number" name="uas[]" id="uas" min="0" max="100" <?= $input ?>>
                                            </td>
                                            <td><input class="form-control" style="width: 150px; <?= $rowSiswa['NIS'] ?>" value="<?= $na ?>" type="text" id="NILAI_AKHIR" disabled></td>
                                            <td>
                                                <a data-nis='<?= $rowSiswa['NIS'] ?>' class='btn btn-danger'>Simpan Siswa</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button class="mt-3 btn btn-primary float-right" type="submit">Simpan Nilai</button>
                        </form>

                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
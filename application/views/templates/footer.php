<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">KAIZEN STUDIO</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- page script Table -->
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
    $(document).ready(function() {
        <?php if ($this->uri->segment(1) == 'Penjadwalan') { ?>
            console.log('masuk controller penjadwalan')
            $('#kode_jurusan').change(function() {
                if ($('#kode_jurusan').val() != '-') {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url("Penjadwalan/tampilKelas"); ?>",
                        data: {
                            idJurusan: $('#kode_jurusan').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#kode_kelas').removeAttr('disabled');
                            $("#kode_kelas").html(response).show();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
            $('#kode_kelas').change(function() {
                if ($('#kode_kelas').val() != null) {
                    chainedSelect();
                }
            });
            $('#kode_mapel').change(function() {
                if ($('#kode_mapel').val() != null) {
                    $('#kode_guru').removeAttr('disabled');
                } else if ($('#kode_mapel').val() == '-') {
                    $('#kode_guru').attr('disabled', 'true');
                }
            });
            $('#kode_guru').change(function() {
                $("#lihat-jadwal").removeClass("disabled");
            });
            $("#lihat-jadwal").click(function() {
                let kode_jurusan = $('#kode_jurusan').val();
                let kode_guru = $('#kode_guru').val();
                let kode_mapel = $('#kode_mapel').val();
                let kode_kelas = $('#kode_kelas option:selected').val();
                if (kode_guru == null || kode_kelas == null || kode_jurusan == null || kode_mapel == null) {
                    alert("cek kembali form");
                    $("#lihat-jadwal").addClass("disabled");

                } else if (kode_guru == '-' || kode_kelas == '-' || kode_jurusan == '-' || kode_mapel == '-') {
                    alert("cek kembali form");
                    $("#lihat-jadwal").addClass("disabled");
                } else {
                    tableJadwal(kode_kelas, kode_jurusan, kode_mapel, kode_guru);
                }
            });

            function chainedSelect() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Penjadwalan/tampilMapel"); ?>",
                    data: {
                        idJurusan: $('#kode_jurusan').val(),
                        kelas: $('#kode_kelas option:selected').text()
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#kode_mapel').removeAttr('disabled');
                        $("#kode_mapel").html(response).show();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }

            function tableJadwal(kode_kelas, kode_jurusan, kode_mapel = null, kode_guru = null) {
                // let kode_guru = $('#kode_guru').val();
                // let kode_kelas = $('#kode_kelas').val();
                // let kode_jurusan = $('#kode_jurusan').val();
                // let kode_mapel = $('#kode_mapel').val();
                // if (kode_guru == null || kode_kelas == null || kode_jurusan == null || kode_mapel == null) {
                //     alert("cek kembali form");
                //     $("#lihat-jadwal").addClass("disabled");

                // } else if (kode_guru == '-' || kode_kelas == '-' || kode_jurusan == '-' || kode_mapel == '-') {
                //     alert("cek kembali form");
                //     $("#lihat-jadwal").addClass("disabled");

                // } else {
                // tableJadwal();
                if (kode_mapel == null) {
                    kode_mapel = $('#kode_mapel').val()
                }
                if (kode_guru == null) {
                    kode_guru = $('#kode_jurusan').val()
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Penjadwalan/tabelJadwal"); ?>",
                    data: {
                        // idJurusan: $('#kode_jurusan').val(),
                        // idGuru: $('#kode_guru').val(),
                        // idMapel: $('#kode_mapel').val(),
                        // kelas: $('#kode_kelas option:selected').val()
                        idJurusan: kode_jurusan,
                        idGuru: kode_guru,
                        idMapel: kode_mapel,
                        kelas: kode_kelas
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log('Jurusan -> ' + response.Jurusan);
                        // console.log('kode_idGuru -> ' + response.kode_idGuru);
                        // console.log('kode_idMapel -> ' + response.kode_idMapel);
                        // console.log('kode_kelas -> ' + response.kode_kelas);
                        $("#data-jadwal").text("Jurusan : " + response.Jurusan + " - " + "Kelas : " + response.kode_kelas);
                        $("#table-jadwal").html(response.tabel).show();
                        $("#btn-plottin").removeClass('disabled');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                $("#table-jadwal").on('click', 'input[type=checkbox]', function() {
                    let dataCheck = $(this).data('inputcheck');
                    if ($(this).is(':checked')) {
                        $("#" + dataCheck).prop('disabled', false)
                    } else {
                        $("#" + dataCheck).prop('disabled', true)
                    }
                });
                $("#table-jadwal").on('click', '.hapus-jadwal', function() {
                    let dataJadwal = $(this).data('jadwal');
                    let dataSesi = $(this).data('sesi');
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url("Penjadwalan/hapusSesi") ?>",
                        data: {
                            kodeJadwal: dataJadwal,
                            kodeSesi: dataSesi
                        },
                        dataType: "json",
                        success: function(e) {
                            if (e.status == 'ok') {
                                tableJadwal(kode_kelas, kode_jurusan);
                            } else {
                                console.log('errror');
                            }
                        }
                    })
                })
                // }

            }
        <?php } ?>

        <?php if ($this->uri->segment(1) == 'Penilaian') { ?>
            console.log('masuk controller penilaian')
            $('#kode_jurusan').change(function() {
                if ($('#kode_jurusan').val() != '-') {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url("Penjadwalan/tampilKelas"); ?>",
                        data: {
                            idJurusan: $('#kode_jurusan').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#kode_kelas').removeAttr('disabled');
                            $("#kode_kelas").html(response).show();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });

            $('#kode_kelas').change(function() {
                if ($('#kode_kelas').val() != null) {
                    chainedSelect();
                }
            });

            // $('#lihat-mapel').click(function() {
            //     let kode_kelas = $('#kode_kelas option:selected').val();
            //     if (kode_kelas == null || kode_kelas == '-') {
            //         alert("cek kembali form");
            //         $("#lihat-mapel").addClass("disabled");
            //     } else {
            //         tableMapel(kode_kelas);
            //     }
            // });

            function tableMapel(kode_kelas) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("Penilaian/tableMapel") ?>",
                    data: {
                        kodeKelas: kode_kelas
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#tbl-mapel").html(response.html).show();
                    }
                });
            }

            function chainedSelect() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Penjadwalan/tampilMapel"); ?>",
                    data: {
                        idJurusan: $('#kode_jurusan').val(),
                        kelas: $('#kode_kelas option:selected').text()
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#kode_mapel').removeAttr('disabled');
                        $("#kode_mapel").html(response).show();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
            <?php if ($this->uri->segment(2) == 'tableNilai') { ?>
                $('.btn-danger').click(function() {
                    let data = $(this).data('nis');
                    $("." + data).removeAttr('disabled');
                })
            <?php } ?>
        <?php } ?>

    });
</script>
</body>

</html>
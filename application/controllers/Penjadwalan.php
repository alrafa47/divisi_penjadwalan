<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjadwalan extends CI_Controller
{
    public $hari = [
        '1' => 'Senin',
        '2' => 'Selasa',
        '3' => 'Rabu',
        '4' => 'Kamis',
        '5' => 'Jumat',
        '6' => 'Sabtu'
    ];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Penjadwalan');
        $this->load->model('M_DetailJadwal');
        $this->load->model('M_Jurusan');
        $this->load->model('M_Sesi');
        $this->load->model('M_Guru');
        $this->load->model('M_Mapel');
        $this->load->model('M_Kelas');
    }

    public function index()
    {
        $data = [
            'hari' => $this->hari,
            'sesi' => $this->M_Sesi->getData(),
            'jurusan' => $this->M_Jurusan->getData(),
            // 'jadwal' => $this->M_Penjadwalan->getData(),
            'mapel' => $this->M_Mapel->getData(),
            'guru' => $this->M_Guru->getData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Penjadwalan/index', $data);
        $this->load->view('templates/footer');
    }

    /* 
    * tampil tabel jadwal
    */
    public function tabelJadwal()
    {
        $Jurusan = $this->M_Jurusan->getData($this->input->post('idJurusan'))['NAMA_JURUSAN'];
        $kode_idGuru = $this->M_Guru->getData($this->input->post('idGuru'))['NAMA_GURU'];
        $kode_idMapel = $this->M_Mapel->getData($this->input->post('idMapel'))->NAMA_MAPEL;
        $kode_kelas = $this->M_Kelas->getData($this->input->post('kelas'))['NAMA_KELAS'];
        // $kode_kelas = $this->input->post('kelas');

        $hari = $this->hari;
        $sesi = $this->M_Sesi->getData();
        $html = "";
        $html .= "<table class='table table-bordered'>";
        $html .= "<tr>";
        $html .= "<th>Waktu</th>";
        foreach ($hari as  $valueHari) :
            $html .= "<th>$valueHari</th>";
        endforeach;
        $html .= "</tr>";
        foreach ($sesi as $valueSesi) :
            $html .= "<tr>";
            $html .= "<td> $valueSesi->JAM_MULAI - $valueSesi->JAM_SELESAI </td>";
            foreach ($hari as $keyHari => $valueHari) :
                $dataPelajaranKelas = $this->M_Penjadwalan->getDataJadwalSesi($keyHari, $this->input->post('kelas'), $valueSesi->KODE_SESI, 'kelas');
                $dataTugasGuru = $this->M_Penjadwalan->getDataJadwalSesi($keyHari, $this->input->post('idGuru'), $valueSesi->KODE_SESI, 'guru');
                $html .= "<td>";
                if ($dataPelajaranKelas) {
                    $html .= "<center><div class='btn btn-danger hapus-jadwal' data-jadwal='$dataPelajaranKelas->KODE_JADWAL' data-sesi='$dataPelajaranKelas->KODE_SESI'>";
                    $html .= "<p style='margin-bottom: 0px;'>$dataPelajaranKelas->NAMA_MAPEL</p>";
                    $html .= "<p style='margin-bottom: 0px;'>$dataPelajaranKelas->NAMA_GURU</p>";
                    $html .= "</div></center>";
                } else if ($dataTugasGuru) {
                    $html .= "<center><div style='' class='btn btn-primary'>";
                    $html .= "<p style='margin-bottom: 0px;'>sudah terjadwal tugas</p>";
                    $html .= "</div></center>";
                } else {
                    $html .= "<center><div class='input-group'>";
                    $html .= "<div class='input-group-prepend'>";
                    $html .= "<span class='input-group-text'>";
                    $html .= "<input data-inputCheck='$valueSesi->KODE_SESI-$valueHari' value='$valueSesi->KODE_SESI' name='" . $valueHari . "[]' type='checkbox'>";
                    $html .= "</span>";
                    $html .= "</div>";
                    $html .= "<input id='$valueSesi->KODE_SESI-$valueHari' type='text' name='keterangan[]' class='form-control' placeholder='Keterangan' disabled>";
                    $html .= "</div></center>";
                }
                $html .= "</td>";
            endforeach;
            $html .= "</tr>";
        endforeach;
        $html .= "</table>";
        $data = [
            'Jurusan' => $Jurusan,
            'kode_idGuru' => $kode_idGuru,
            'kode_idMapel' => $kode_idMapel,
            'kode_kelas' => $kode_kelas,
            'tabel' => $html
        ];
        echo json_encode($data);
    }

    /* 
    * tampil Kelas
    */
    public function tampilKelas()
    {
        $jurusan = $this->input->post('idJurusan');
        $data = $this->M_Kelas->getData($jurusan, 'jurusan');
        $html = "<option value='-'>pilih kelas</option>";
        foreach ($data as $value) {
            $html .= "<option value='" . $value['KODE_KELAS'] . "' data-kelas='" . $value['NAMA_KELAS'] . "' >" . $value['NAMA_KELAS'] . "</option>";
        }
        echo json_encode($html);
    }

    /* 
    * tampil Mapel
    */
    public function tampilMapel()
    {
        $jurusan = $this->input->post('idJurusan');
        $kelas = $this->input->post('kelas');
        $data = $this->M_Mapel->getData($jurusan, 'kode_jurusan');
        $html = "<option value='-'>pilih mapel</option>";
        foreach ($data as $value) {
            $html .= "<option value='$value->KODE_MAPEL'>$value->NAMA_MAPEL.</option>";
        }
        echo json_encode($html);
    }

    /* 
    * tampil data detail 
    * param kode_jadwal {String} : kode_jadwal
    */
    public function detail($kode_jadwal)
    {
        $data = [
            'jadwal' => $this->M_Penjadwalan->getData($kode_jadwal)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Penjadwalan/detail', $data);
        $this->load->view('templates/footer');
    }

    /* 
    * untuk tampil data ubah
    */
    public function ubah($id)
    {
        $data = [
            'jadwal' => $this->M_Penjadwalan->getData($id)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Penjadwalan/ubah', $data);
        $this->load->view('templates/footer');
    }

    /* 
        *validasi Inputan Penjadwalan
    */
    public function validation()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'required');
        return ($this->form_validation->run() == FALSE) ? false : true;
    }


    /* 
    * untuk create data mahasiswa
    */
    public function tambahData()
    {
        // if ($this->validation()) {
        foreach ($this->hari as $keyHari => $valueHari) {
            $jadwalHari = $this->input->post($valueHari);
            if (!empty($jadwalHari)) {
                $kodeJadwal = "JDWL" . date("YmdHis");
                $kode_mapel = $this->input->post('kode_mapel');
                $kode_guru = $this->input->post('kode_guru');
                $kode_kelas = $this->input->post('kode_kelas');
                // Penjadwalan
                $dataJadwal = [
                    'KODE_JADWAL' => $kodeJadwal,
                    'KODE_MAPEL' => $kode_mapel,
                    'HARI' => $keyHari,
                    'KODE_KELAS' =>  $kode_kelas,
                    'NIG' =>  $kode_guru
                ];

                $cekJadwal = $this->M_Penjadwalan->cekJadwal($keyHari, $kode_kelas, $kode_guru);
                if (!$cekJadwal) {
                    $this->M_Penjadwalan->addData($dataJadwal);
                } else {
                    $kodeJadwal = $cekJadwal->KODE_JADWAL;
                }
                // detail Jadwal
                $keterangan = $this->input->post('keterangan');
                foreach ($jadwalHari as $key => $valueSesi) {
                    $dataSesi  = [
                        'KODE_JADWAL' => $kodeJadwal,
                        'KODE_SESI' => $valueSesi,
                        'KETERANGAN' => $keterangan[$key]
                    ];
                    // print_r($dataSesi);
                    $this->M_DetailJadwal->addData($dataSesi);
                    // echo '<br>';
                }
                $this->session->set_flashdata('flash_penjadwalan', 'Ditambahkan');
                redirect('Penjadwalan');
            }
            //  else {
            //     echo "tidak ada";
            // }
        }
        // } else {
        //     $this->index();
        // }
    }

    /* 
    * untuk update data mahasiswa
    */
    public function updateData()
    {
        if ($this->validation()) {
            $this->M_Penjadwalan->updateMahasiswa();
            $this->session->set_flashdata('flash_penjadwalan', 'Diupdate');
            redirect('Penjadwalan');
        } else {
            $this->ubah($this->input->post('id'));
        }
    }

    /* 
    * untuk delete data mahasiswa
    */
    public function deleteData($id)
    {
        $this->M_Penjadwalan->deleteMahasiswa($id);
        $this->session->set_flashdata('flash_penjadwalan', 'Dihapus');
        redirect('Penjadwalan');
    }

    public function hapusSesi()
    {
        $kode_sesi = $this->input->post('kodeSesi');
        $kode_jadwal = $this->input->post('kodeJadwal');
        if ($this->M_DetailJadwal->delete($kode_jadwal, $kode_sesi)) {
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}

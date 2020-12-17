<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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
        $this->load->model('M_Penilaian');
        $this->load->model('M_Sesi');
        $this->load->model('M_Jurusan');
        $this->load->model('M_Penjadwalan');
        $this->load->model('M_Guru');
        $this->load->model('M_Mapel');
        $this->load->model('M_Siswa');
    }

    public function index()
    {
        $data = [
            'hari' => $this->hari,
            'sesi' => $this->M_Sesi->getData(),
            'jurusan' => $this->M_Jurusan->getData(),
            'jadwal' => $this->M_Penjadwalan->getData(),
            'mapel' => $this->M_Mapel->getData(),
            'guru' => $this->M_Guru->getData(),
            'penilaian' => $this->M_Penilaian->getData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function tableMapel($kodeKelas = null)
    {
        if ($kodeKelas == null) {
            $kodeKelas = $this->input->get('kode_kelas');
        }
        $dataMapel = $this->M_Penjadwalan->getDataMapel($kodeKelas);
        if ($dataMapel != null) {
            $data = [
                'mapel' => $dataMapel
            ];
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('Penilaian/detail', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Penilaian');
        }
    }

    public function tableNilai($kodeKelas, $kodeJadwal)
    {
        $dataPenilaian = $this->M_Penilaian->getData($kodeJadwal, 'kode_jadwal');
        $dataSiswa = $this->M_Siswa->getData($kodeKelas, 'kelas');
        if ($dataSiswa != null) {
            $data = [
                'penilaian' => $dataPenilaian,
                'siswa' => $dataSiswa
            ];
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('Penilaian/detailPenilaian', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Penilaian/tableMapel/' . $kodeKelas);
        }
    }


    /* 
    * tampil data detail 
    * param kode_penilaian {String} : kode_penilaian
    */
    public function detail($kode_penilaian)
    {
        $data = [
            'penilaian' => $this->M_Penilaian->getData($kode_penilaian)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Penilaian/detail', $data);
        $this->load->view('templates/footer');
    }

    /* 
        *validasi Inputan Penilaian
    */
    public function validation()
    {
        $this->form_validation->set_rules('uh1', 'uh1', 'required');
        $this->form_validation->set_rules('uh2', 'uh2', 'required');
        $this->form_validation->set_rules('uts', 'uts', 'required');
        $this->form_validation->set_rules('uas', 'uas', 'required');
        return ($this->form_validation->run() == FALSE) ? false : true;
    }


    /* 
    * untuk create data penilaian
    */
    public function tambahData($kodeMapel, $kodeJadwal)
    {
        // if ($this->validation()) {
        $nis = $this->input->post('nis');
        $uh1 = $this->input->post('uh1');
        $uh2 = $this->input->post('uh2');
        $uts = $this->input->post('uts');
        $uas = $this->input->post('uas');
        foreach ($nis as $key => $value) {
            $NA = 0;
            if ($uh1[$key] == "") {
                $uh1[$key] = 0;
            }
            if ($uh2[$key] == "") {
                $uh2[$key] = 0;
            }
            if ($uts[$key] == "") {
                $uts[$key] = 0;
            }
            if ($uas[$key] == "") {
                $uas[$key] = 0;
            }

            $NA = ($uh1[$key] + $uh2[$key] + $uts[$key] + $uas[$key]) / 4;
            $data = [
                'NIS' => $value,
                'KODE_JADWAL' => $kodeJadwal,
                'ULANGAN1' => $uh1[$key],
                'ULANGAN2' => $uh2[$key],
                'UTS' => $uts[$key],
                'UAS' => $uas[$key],
                'NILAI_AKHIR' => $NA
            ];
            // checkif value exist

            $this->M_Penilaian->addData($data);
        }
        $this->session->set_flashdata('flash_penilaian', 'Data Berhasil Ditambahkan');
        redirect("Penilaian/tableNilai/$kodeMapel/$kodeJadwal");
        // } else {
        //     $this->session->set_flashdata('flash_penilaian', 'Data Gagal Ditambahkan, ');
        //     redirect("Penilaian/tableNilai/$kodeMapel/$kodeJadwal");
        // }
    }

    /* 
    * untuk delete data penilaian
    */
    public function deleteData($id)
    {
        $this->M_Penilaian->deletePenilaian($id);
        $this->session->set_flashdata('flash_penilaian', 'Dihapus');
        redirect('Penilaian');
    }
}

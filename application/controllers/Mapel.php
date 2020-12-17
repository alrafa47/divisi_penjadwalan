<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Mapel');
        $this->load->model('M_Jurusan');
    }

    public function index()
    {
        $data = [
            'mapel' => $this->M_Mapel->getData(),
            'jurusan' => $this->M_Jurusan->getData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Mapel/index', $data);
        $this->load->view('templates/footer');
    }


    /* 
    * tampil data detail 
    * param kode_mapel {String} : kode_mapel
    */
    public function detail($kode_mapel)
    {
        $data = [
            'mapel' => $this->M_Mapel->getData($kode_mapel)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Mapel/detail', $data);
        $this->load->view('templates/footer');
    }

    /* 
    * untuk tampil data ubah
    */
    public function ubah($id)
    {
        $data = [
            'mapel' => $this->M_Mapel->getData($id),
            'jurusan' => $this->M_Jurusan->getData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Mapel/ubah', $data);
        $this->load->view('templates/footer');
    }

    /* 
        *validasi Inputan Mapel
    */
    public function validation($action)
    {
        $action = ($action == 'tambah') ? '|is_unique[MAPEL.KODE_MAPEL]' : '';
        $this->form_validation->set_rules('nama_mapel', 'Nama Mapel', 'required');
        return ($this->form_validation->run() == FALSE) ? false : true;
    }


    /* 
    * untuk create data mahasiswa
    */
    public function tambahData()
    {
        if ($this->validation('tambah')) {
            foreach ($this->input->post('kelas') as $value) {
                $data = [
                    'KODE_MAPEL' => $value . "-" . $this->input->post('kode_mapel') . "-" . $this->input->post('kode_jurusan'),
                    'NAMA_MAPEL' => $this->input->post('nama_mapel'),
                    'KODE_JURUSAN' => $this->input->post('kode_jurusan'),
                    'STATUS_MAPEL' => $this->input->post('status_mapel')
                ];
                $this->M_Mapel->addData($data);
            }

            $this->session->set_flashdata('flash_mapel', 'Ditambahkan');
            redirect('Mapel');
        } else {
            $this->index();
        }
    }

    /* 
    * untuk update data mahasiswa
    */
    public function updateData()
    {
        if ($this->validation('update')) {
            $data = [
                'KODE_MAPEL' => $this->input->post('kode_mapel'),
                'NAMA_MAPEL' => $this->input->post('nama_mapel'),
                'KODE_JURUSAN' => $this->input->post('kode_jurusan'),
                'STATUS_MAPEL' => $this->input->post('status_mapel')
            ];
            $this->M_Mapel->updateData($this->input->post('kode_mapel'), $data);
            $this->session->set_flashdata('flash_mapel', 'Diupdate');
            redirect('Mapel');
        } else {
            $this->ubah($this->input->post('kode_mapel'));
        }
    }

    /* 
    * untuk delete data mahasiswa
    */
    public function deleteData($id)
    {
        if ($this->M_Mapel->delete($id)) {
            $this->session->set_flashdata('flash_mapel', 'Dihapus');
        }
        redirect('Mapel');
    }
}

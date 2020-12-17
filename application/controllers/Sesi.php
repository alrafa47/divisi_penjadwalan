<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Sesi');
    }

    public function index()
    {
        $data = [
            'sesi' => $this->M_Sesi->getData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Sesi/index', $data);
        $this->load->view('templates/footer');
    }


    /* 
    * tampil data detail 
    * param kode_sesi {String} : kode_sesi
    */
    public function detail($kode_sesi)
    {
        $data = [
            'sesi' => $this->M_Sesi->getData($kode_sesi)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Sesi/detail', $data);
        $this->load->view('templates/footer');
    }

    /* 
    * untuk tampil data ubah
    */
    public function ubah($id)
    {
        $data = [
            'sesi' => $this->M_Sesi->getData($id)
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('Sesi/ubah', $data);
        $this->load->view('templates/footer');
    }

    /* 
        *validasi Inputan Sesi
    */
    public function validation($action)
    {
        $action = ($action == 'tambah') ? '|is_unique[sesi_jam.KODE_SESI]' : '';
        $this->form_validation->set_rules('kode_sesi', 'Kode Sesi', 'required' . $action);
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        return ($this->form_validation->run() == FALSE) ? false : true;
    }

    /* 
    * untuk create data Sesi
    */
    public function tambahData()
    {
        if ($this->validation('tambah')) {
            $data  = [
                'KODE_SESI' => $this->input->post('kode_sesi'),
                'JAM_MULAI' => $this->input->post('jam_mulai'),
                'JAM_SELESAI' => $this->input->post('jam_selesai'),
            ];
            $this->M_Sesi->addData($data);
            $this->session->set_flashdata('flash_sesi', 'Ditambahkan');
            redirect('Sesi');
        } else {
            $this->index();
        }
    }

    /* 
    * untuk update data Sesi
    */
    public function updateData()
    {
        if ($this->validation('update')) {
            $data  = [
                'JAM_MULAI' => $this->input->post('jam_mulai'),
                'JAM_SELESAI' => $this->input->post('jam_selesai')
            ];
            $this->M_Sesi->updateData($this->input->post('kode_sesi'), $data);
            $this->session->set_flashdata('flash_sesi', 'Diupdate');
            redirect('Sesi');
        } else {
            $this->ubah($this->input->post('id'));
        }
    }

    /* 
    * untuk delete data Sesi
    */
    public function deleteData($id)
    {
        $this->M_Sesi->delete($id);
        $this->session->set_flashdata('flash_sesi', 'Dihapus');
        redirect('Sesi');
    }
}

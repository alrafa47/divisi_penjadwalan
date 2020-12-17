<?php
defined('BASEPATH') or exit('No direct script access allowed');
// nama class harus sama dengan nama file
class Model_Siswa extends CI_Model
{
    /* 
    CREATE TABLE `siswa` (
        `NIS` varchar(17) NOT NULL,
        `NAMA_SISWA` varchar(100) NOT NULL,
        `ALAMAT` varchar(255) NOT NULL,
        `JK` varchar(1) NOT NULL,
        `TEMPAT_LAHIR` varchar(16) NOT NULL,
        `TGL_LAHIR` date NOT NULL,
        `KODE_JURUSAN` int(11) NOT NULL,
        `KODE_KELAS` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */

    /* 
    * description untuk mengambil data
    * param KODE_KELAS : KODE_KELAS 
    * return {array} : data kelas 
    */
    public function getData($id = null, $kategori)
    {
        // jika tidak ada KODE_KELAS 
        if ($id === null) {
            // maka ambil semua
            return $this->db->get('siswa')->result();
        } else {
            switch ($kategori) {
                case 'nis':
                    return $this->db->get_where('siswa', ['NIS' => $id])->row();
                    break;
                case 'kelas':
                    return $this->db->get_where('siswa', ['KODE_KELAS' => $id])->result();
                    break;
            }
            // maka ambil berdasarkan KODE_KELAS
        }
    }

    /* 
    * description untuk delete data
    * param KODE_KELAS {String} : KODE_KELAS 
    * return {boolean}
    */
    public function delete($nis = null)
    {
        // perintah delete 
        $this->db->delete('siswa', ['NIS' => $nis]);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk menambah data
    * param data {Array} : data kelas yang dikirim dari controller kelas
    * return {boolean}
    */
    public function addData($data)
    {
        // insert ke table kelas
        // $data  = [
        //     'NIS' => $this->input->post('nis'),
        //     'NAMA_SISWA' => $this->input->post('nama_siswa'),
        //     'ALAMAT' => $this->input->post('alamat'),
        //     'JK' => $this->input->post('jk'),
        //     'TEMPAT_LAHIR' => $this->input->post('tempat_lahir'),
        //     'TGL_LAHIR' => $this->input->post('tgl_lahir'),
        //     'KODE_JURUSAN' => $this->input->post('kode_jurusan'),
        //     'KODE_KELAS' => $this->input->post('kode_kelas')
        // ];
        $this->db->insert('siswa', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param KODE_KELAS {String} : KODE_KELAS 
    * param data {Array} : data kelas yang dikirim dari controller kelas
    * return {boolean}
    */
    public function updateData($nis, $data)
    {
        $data  = [
            'NAMA_SISWA' => $this->input->post('nama_siswa'),
            'ALAMAT' => $this->input->post('alamat'),
            'JK' => $this->input->post('jk'),
            'TEMPAT_LAHIR' => $this->input->post('tempat_lahir'),
            'TGL_LAHIR' => $this->input->post('tgl_lahir'),
            'KODE_JURUSAN' => $this->input->post('kode_jurusan'),
            'KODE_KELAS' => $this->input->post('kode_kelas')
        ];
        $this->db->update('siswa', $data, ['NIS' => $nis]);
        return $this->db->affected_rows();
    }
}

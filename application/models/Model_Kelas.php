<?php
defined('BASEPATH') or exit('No direct script access allowed');
// nama class harus sama dengan nama file
class Model_Kelas extends CI_Model
{
    /* 
    CREATE TABLE `kelas_pertahun` (
        `KODE_KELAS` int(11) NOT NULL,
        `NAMA_KELAS` int(11) NOT NULL,
        `NIG` varchar(16) NOT NULL,
        `TAHUN_JARAN` varchar(9) NOT NULL,
        `KODE_JURUSAN` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */

    /* 
    * description untuk mengambil data
    * param KODE_KELAS : KODE_KELAS 
    * return {array} : data kelas 
    */
    public function getData($kode = null, $field = null)
    {
        // jika tidak ada KODE_KELAS 
        if ($kode === null) {
            // maka ambil semua
            return $this->db->get('kelas_pertahun')->result();
        } else {
            // maka ambil berdasarkan KODE_KELAS
            switch ($field) {
                case 'jurusan':
                    return $this->db->get_where('kelas_pertahun', ['KODE_JURUSAN' => $kode])->result();
                    break;
                default:
                    return $this->db->get_where('kelas_pertahun', ['KODE_KELAS' => $kode])->row();
                    break;
            }
        }
    }

    /* 
    * description untuk delete data
    * param KODE_KELAS {String} : KODE_KELAS 
    * return {boolean}
    */
    public function delete($kode_kelas = null)
    {
        // perintah delete 
        $this->db->delete('kelas_pertahun', ['KODE_KELAS' => $kode_kelas]);
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
        $data  = [
            'KODE_KELAS' => $this->input->post('kode_kelas'),
            'NAMA_KELAS' => $this->input->post('nama_kelas'),
            'NIG' => $this->input->post('nig'),
            'TAHUN_JARAN' => $this->input->post('tahun_jaran'),
            'KODE_JURUSAN' => $this->input->post('kode_jurusan')
        ];
        $this->db->insert('kelas_pertahun', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param KODE_KELAS {String} : KODE_KELAS 
    * param data {Array} : data kelas yang dikirim dari controller kelas
    * return {boolean}
    */
    public function updateData($kode_kelas, $data)
    {
        $data  = [
            'NAMA_KELAS' => $this->input->post('nama_kelas'),
            'NIG' => $this->input->post('nig'),
            'TAHUN_JARAN' => $this->input->post('tahun_jaran'),
            'KODE_JURUSAN' => $this->input->post('kode_jurusan')
        ];
        $this->db->update('kelas_pertahun', $data, ['KODE_KELAS' => $kode_kelas]);
        return $this->db->affected_rows();
    }
}

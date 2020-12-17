<?php
defined('BASEPATH') or exit('No direct script access allowed');
// nama class harus sama dengan nama file
class Model_Guru extends CI_Model
{
    /* 
    CREATE TABLE `guru` (
        `id_guru` int(11) NOT NULL,
        `nama_guru` varchar(32) NOT NULL,
        `status` varchar(10) NOT NULL,
        `pendidikan_terakhir` varchar(10) NOT NULL,
        `no_telp` varchar(16) NOT NULL,
        `email` varchar(32) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    */

    /* 
    * description untuk mengambil data
    * param NIG : NIG 
    * return {array} : data sesi 
    */
    public function getData($id_guru = null)
    {
        // jika tidak ada NIG 
        if ($id_guru === null) {
            // maka ambil semua
            return $this->db->get('guru')->result();
        } else {
            // maka ambil berdasarkan NIG
            return $this->db->get_where('guru', ['NIG' => $id_guru])->row();
        }
    }

    /* 
    * description untuk delete data
    * param NIG {String} : NIG 
    * return {boolean}
    */
    public function delete($id_guru = null)
    {
        // perintah delete 
        $this->db->delete('guru', ['NIG' => $id_guru]);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk menambah data
    * param data {Array} : data sesi yang dikirim dari controller sesi
    * return {boolean}
    */
    public function addData($data)
    {
        // insert ke table sesi
        // $data  = [
        //     'NIG' => $this->input->post('id_guru'),
        //     'NAMA_GURU' => $this->input->post('nama_guru'),
        //     'STATUS' => $this->input->post('status'),
        //     'PENDIDIKAN_TERAKHIR' => $this->input->post('pendidikan_terakhir'),
        //     'NO_TELP' => $this->input->post('no_telp'),
        //     'EMAIL' => $this->input->post('email')
        // ];
        $this->db->insert('guru', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param NIG {String} : NIG 
    * param data {Array} : data sesi yang dikirim dari controller sesi
    * return {boolean}
    */
    public function updateData($id_guru, $data)
    {
        $data  = [
            'NAMA_GURU' => $this->input->post('nama_guru'),
            'STATUS' => $this->input->post('status'),
            'PENDIDIKAN_TERAKHIR' => $this->input->post('pendidikan_terakhir'),
            'NO_TELP' => $this->input->post('no_telp'),
            'EMAIL' => $this->input->post('email')
        ];
        $this->db->update('guru', $data, ['NIG' => $id_guru]);
        return $this->db->affected_rows();
    }
}

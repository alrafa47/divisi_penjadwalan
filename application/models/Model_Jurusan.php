<?php
defined('BASEPATH') or exit('No direct script access allowed');
// nama class harus sama dengan nama file
class Model_Jurusan extends CI_Model
{


    /* 
    * description untuk mengambil data
    * param id_jurusan : id_jurusan 
    * return {array} : data sesi 
    */
    public function getData($id_jurusan = null)
    {
        // jika tidak ada id_jurusan 
        if ($id_jurusan == null) {
            // maka ambil semua
            return $this->db->get('jurusan')->result();
        } else {
            // maka ambil berdasarkan id_jurusan
            return $this->db->get_where('jurusan', ['KODE_JURUSAN' => $id_jurusan])->row();
        }
    }

    /* 
    * description untuk delete data
    * param id_jurusan {String} : id_jurusan 
    * return {boolean}
    */
    public function delete($id_jurusan = null)
    {
        // perintah delete 
        $this->db->delete('jurusan', ['id_jurusan' => $id_jurusan]);
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
        $data  = [
            'KODE_JURUSAN' => $this->input->post('kode_jurusan'),
            'NAMA_JURUSAN' => $this->input->post('nama_jurusan')
        ];
        $this->db->insert('jurusan', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param id_jurusan {String} : id_jurusan 
    * param data {Array} : data sesi yang dikirim dari controller sesi
    * return {boolean}
    */
    public function updateData($id_jurusan, $data)
    {
        $data  = [
            'NAMA_JURUSAN' => $this->input->post('nama_jurusan')
        ];
        $this->db->update('jurusan', $data, ['KODE_JURUSAN' => $id_jurusan]);
        return $this->db->affected_rows();
    }
}

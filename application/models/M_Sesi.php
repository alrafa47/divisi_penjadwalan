<?php
// nama class harus sama dengan nama file
class M_sesi extends CI_Model
{
    /* 
    CREATE TABLE `sesi_jam` (
    `KODE_SESI` int(11) NOT NULL,
    `JAM_MULAI` varchar(5) NOT NULL,
    `JAM_SELESAI` varchar(5) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */


    /* 
    * description untuk mengambil data
    * param KODE_SESI : KODE_SESI 
    * return {array} : data sesi 
    */
    public function getData($kode_sesi = null)
    {
        // jika tidak ada KODE_SESI 
        if ($kode_sesi === null) {
            // maka ambil semua
            return $this->db->get('sesi_jam')->result();
        } else {
            // maka ambil berdasarkan KODE_SESI
            return $this->db->get_where('sesi_jam', ['KODE_SESI' => $kode_sesi])->row();
        }
    }

    /* 
    * description untuk delete data
    * param KODE_SESI {String} : KODE_SESI 
    * return {boolean}
    */
    public function delete($kode_sesi = null)
    {
        // perintah delete 
        $this->db->delete('sesi_jam', ['KODE_SESI' => $kode_sesi]);
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
        $this->db->insert('sesi_jam', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param KODE_SESI {String} : KODE_SESI 
    * param data {Array} : data sesi yang dikirim dari controller sesi
    * return {boolean}
    */
    public function updateData($kode_sesi, $data)
    {
        $this->db->update('sesi_jam', $data, ['KODE_SESI' => $kode_sesi]);
        return $this->db->affected_rows();
    }
}

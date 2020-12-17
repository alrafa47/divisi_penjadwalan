<?php
// nama class harus sama dengan nama file
class M_DetailJadwal extends CI_Model
{
    /* 
    * description untuk mengambil data
    * param id : id mahasiswa
    * return {array} : data mahasiswa 
    */
    public function getData($kode_jadwal = null, $kode_sesi = null)
    {
        // jika tidak ada id 
        if ($kode_jadwal === null) {
            // maka ambil semua
            return $this->db->get('detail_jadwal_sesi')->result();
        } else {
            // maka ambil berdasarkan id
            return $this->db->get_where('detail_jadwal_sesi', ['KODE_SESI' => $kode_sesi, 'KODE_JADWAL' => $kode_jadwal])->row();
        }
    }

    /* 
    * description untuk delete data
    * param id {String} : id mahasiswa
    * return {boolean}
    */
    public function delete($kode_jadwal = null, $kode_sesi = null)
    {
        // perintah delete 
        $this->db->delete('detail_jadwal_sesi', ['KODE_SESI' => $kode_sesi, 'KODE_JADWAL' => $kode_jadwal]);
        return $this->db->affected_rows();
    }

    /* 
    * @description untuk menambah data
    * @param data {Array} : data sesi yang dikirim dari controller sesi
    * @return {boolean}
    */
    public function addData($data)
    {
        // insert ke table sesi
        $this->db->insert('detail_jadwal_sesi', $data);
        return $this->db->affected_rows();
    }

    /* 
    * @description untuk update data
    * @param KODE_SESI {String} : KODE_SESI sesi
    * @param data {Array} : data sesi yang dikirim dari controller sesi
    * @return {boolean}
    */
    public function updateData($kode_jadwal, $kode_sesi, $data)
    {
        $data  = [
            'KODE_JADWAL' => $this->input->post('kode_jadwal'),
            'KODE_SESI' => $this->input->post('kode_sesi'),
            'KETERANGAN' => $this->input->post('keterangan'),
        ];
        $this->db->update('sesi', $data, ['KODE_SESI' => $kode_sesi, 'KODE_JADWAL' => $kode_jadwal]);
        return $this->db->affected_rows();
    }
}

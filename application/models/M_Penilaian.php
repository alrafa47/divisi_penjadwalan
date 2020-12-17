<?php
// nama class harus sama dengan nama file
class M_Penilaian extends CI_Model
{
    /* 
    CREATE TABLE `penilaian` (
    `KODE_PENILAIAN` int(11) NOT NULL,
    `NIS` varchar(17) NOT NULL,
    `KODE_JADWAL` varchar(32) NOT NULL,
    `ULANGAN1` int(11) NOT NULL,
    `ULANGAN2` int(11) NOT NULL,
    `UTS` int(11) NOT NULL,
    `UAS` int(11) NOT NULL,
    `NILAI_AKHIR` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */

    /* 
    * description untuk mengambil data
    * param id : kode penilaian
    * return {array} : data mahasiswa 
    */
    public function getData($kode = null, $kategori = null)
    {
        // jika tidak ada id 
        if ($kode === null) {
            // maka ambil semua
            return $this->db->get('penilaian')->result();
        } else {
            switch ($kategori) {
                case 'kode_penilaian':
                    return $this->db->get_where('penilaian', ['KODE_PENILAIAN' => $kode])->row();
                    break;
                case 'kode_jadwal':
                    return $this->db->get_where('penilaian', ['KODE_JADWAL' => $kode])->result();
                    break;
            }
            // maka ambil berdasarkan id
        }
    }

    /* 
    * description untuk delete data
    * param id {String} : kode penilaian
    * return {boolean}
    */
    public function delete($kode_penilaian = null)
    {
        // perintah delete 
        $this->db->delete('penilaian', ['KODE_PENILAIAN' => $kode_penilaian]);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk menambah data
    * param data {Array} : data mahasiswa yang dikirim dari controller mahasiswa
    * return {boolean}
    */
    public function addData($data)
    {
        // insert ke table mahasiswa
        $this->db->insert('penilaian', $data);
        return $this->db->affected_rows();
    }

    /* 
    * description untuk update data
    * param id {String} : kode penilaian
    * param data {Array} : data mahasiswa yang dikirim dari controller mahasiswa
    * return {boolean}
    */
    public function updateData($kode_penilaian, $data)
    {
        $data = [
            'NIS' => $this->input->post('nis'),
            'KODE_JADWAL' => $this->input->post('kode_jadwal'),
            'ULANGAN1' => $this->input->post('ulangan1'),
            'ULANGAN2' => $this->input->post('ulangan2'),
            'UTS' => $this->input->post('uts'),
            'UAS' => $this->input->post('uas'),
            'NILAI_AKHIR' => $this->input->post('nilai_akhir')
        ];
        $this->db->update('penilaian', $data, ['KODE_PENILAIAN' => $kode_penilaian]);
        return $this->db->affected_rows();
    }
}

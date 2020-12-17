<?php
// nama class harus sama dengan nama file
class M_Mapel extends CI_Model
{
    /* 
    * @description untuk mengambil data
    * @param id : id mapel
    * @return {array} : data mapel 
    */


    /* CREATE TABLE `mapel` (
    `KODE_MAPEL` int(11) NOT NULL,
    `NAMA_MAPEL` varchar(32) NOT NULL,
    `KODE_JURUSAN` int(11) NOT NULL,
    `STATUS_MAPEL` varchar(16) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */
    public function getData($kode = null, $field = null)
    {
        // jika tidak ada kode_mapel 
        if ($kode === null) {
            // maka ambil semua
            return $this->db->get('mapel')->result();
        } else {
            // maka ambil berdasarkan kode_mapel
            switch ($field) {
                case 'kode_jurusan':
                    $this->db->where('KODE_JURUSAN', $kode);
                    $kelas = explode("-", $this->input->post('kelas'));
                    $this->db->like('KODE_MAPEL', $kelas[0], 'both');
                    return $this->db->get('mapel')->result();
                    break;
                default:
                    return $this->db->get_where('mapel', ['KODE_MAPEL' => $kode])->row();
                    break;
            }
        }
    }

    /* 
    * @description untuk delete data
    * @param KODE_MAPEL {String} : KODE_MAPEL
    * @return {boolean}
    */
    public function delete($kode_mapel = null)
    {
        // perintah delete 
        $this->db->delete('mapel', ['KODE_MAPEL' => $kode_mapel]);
        return $this->db->affected_rows();
    }

    /* 
    * @description untuk menambah data
    * @param data {Array} : data mapel yang dikirim dari controller mapel
    * @return {boolean}
    */
    public function addData($data)
    {
        // insert ke table mapel
        $this->db->insert('mapel', $data);
        return $this->db->affected_rows();
    }

    /* 
    * @description untuk update data
    * @param id {String} : id mapel
    * @param data {Array} : data mapel yang dikirim dari controller mapel
    * @return {boolean}
    */
    public function updateData($kode_mapel, $data)
    {
        $this->db->update('mapel', $data, ['KODE_MAPEL' => $kode_mapel]);
        return $this->db->affected_rows();
    }
}

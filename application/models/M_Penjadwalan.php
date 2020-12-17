<?php
// nama class harus sama dengan nama file
class M_Penjadwalan extends CI_Model
{
    /*
    CREATE TABLE `penjadwalan_mapel` ( 
        `KODE_JADWAL` varchar(32) NOT NULL,
        `KODE_MAPEL` int(11) NOT NULL,
        `HARI` varchar(1) NOT NULL,
        `KODE_KELAS` int(11) NOT NULL,
        `NIG` varchar(16) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 
    */
    /* 
    * @description untuk mengambil data
    * @param id : id mahasiswa
    * @return {array} : data mahasiswa 
    */
    public function getData($kode_jadwal = null)
    {
        // jika tidak ada id 
        if ($kode_jadwal === null) {
            // maka ambil semua
            return $this->db->get('penjadwalan_mapel')->result();
        } else {
            // maka ambil berdasarkan id
            return $this->db->get_where('penjadwalan_mapel', ['KODE_JADWAL' => $kode_jadwal])->row();
        }
    }

    public function getDataMapel($kodeKelas)
    {
        $this->db->select('penjadwalan_mapel.KODE_JADWAL, penjadwalan_mapel.KODE_KELAS, mapel.*');
        $this->db->join('mapel', 'penjadwalan_mapel.KODE_MAPEL = mapel.KODE_MAPEL');
        $this->db->group_by('penjadwalan_mapel.KODE_MAPEL');
        return $this->db->get_where('penjadwalan_mapel', ['KODE_KELAS' => $kodeKelas])->result();
    }

    public function getDataJadwalSesi($hari, $id, $sesi, $type)
    {
        $this->db->select('penjadwalan_mapel.*, detail_jadwal_sesi.KETERANGAN, detail_jadwal_sesi.KODE_SESI, guru.NAMA_GURU, Mapel.NAMA_MAPEL, mapel.STATUS_MAPEL');
        $this->db->from('penjadwalan_mapel');
        $this->db->join('guru', 'penjadwalan_mapel.NIG = guru.NIG');
        $this->db->join('detail_jadwal_sesi', 'penjadwalan_mapel.KODE_JADWAL = detail_jadwal_sesi.KODE_JADWAL');
        $this->db->join('mapel', 'penjadwalan_mapel.KODE_MAPEL = mapel.KODE_MAPEL');
        $this->db->where('HARI', $hari);
        $this->db->where('KODE_SESI', $sesi);
        switch ($type) {
            case 'kelas':
                $this->db->where('KODE_KELAS', $id);
                break;
            case 'guru':
                $this->db->where('penjadwalan_mapel.NIG', $id);
                break;
        }


        // return $this->db->query("SELECT penjadwalan_mapel.*, detail_jadwal_sesi.KETERANGAN, detail_jadwal_sesi.KODE_SESI, guru.NAMA_GURU, Mapel.NAMA_MAPEL, mapel.STATUS_MAPEL FROM penjadwalan_mapel JOIN guru ON penjadwalan_mapel.NIG = guru.NIG JOIN detail_jadwal_sesi ON penjadwalan_mapel.KODE_JADWAL = detail_jadwal_sesi.KODE_JADWAL JOIN mapel ON penjadwalan_mapel.KODE_MAPEL = mapel.KODE_MAPEL WHERE HARI ='$hari' && KODE_KELAS='$kelas' && KODE_SESI='$sesi'")->row();
        return $this->db->get()->row();
    }

    /* 
    * @description untuk delete data
    * @param id {String} : id mahasiswa
    * @return {boolean}
    */
    public function delete($kode_jadwal = null)
    {
        // perintah delete 
        $this->db->delete('penjadwalan_mapel', ['KODE_JADWAL' => $kode_jadwal]);
        return $this->db->affected_rows();
    }

    public function cekJadwal($hari, $kode_kelas, $NIG)
    {
        $this->db->where('HARI', $hari);
        $this->db->where('KODE_KELAS', $kode_kelas);
        $this->db->where('NIG', $NIG);
        return $this->db->get('penjadwalan_mapel')->row();
    }

    /* 
    * @description untuk menambah data
    * @param data {Array} : data mahasiswa yang dikirim dari controller mahasiswa
    * @return {boolean}
    */
    public function addData($data)
    {
        // insert ke table mahasiswa
        $this->db->insert('penjadwalan_mapel', $data);
        return $this->db->affected_rows();
    }

    /* 
    * @description untuk update data
    * @param id {String} : id mahasiswa
    * @param data {Array} : data mahasiswa yang dikirim dari controller mahasiswa
    * @return {boolean}
    */
    public function updateData($kode_jadwal, $data)
    {
        $data = [
            `KODE_MAPEL` => $this->input->post('kode_mapel'),
            `HARI` => $this->input->post('hari'),
            `KODE_KELAS` => $this->input->post('kode_kelas'),
            `NIG` => $this->input->post('nig')
        ];
        $this->db->update('penjadwalan_mapel', $data, ['KODE_JADWAL' => $kode_jadwal]);
        return $this->db->affected_rows();
    }
}

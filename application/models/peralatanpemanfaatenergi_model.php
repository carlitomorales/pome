<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class peralatanpemanfaatenergi_model extends CI_Model
{

    public function __construct()
    {
        //$this->load->database();
    }

    public function insert($data)
    {
        $this->db->insert('t_peralatan_pemanfaat_energi', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function edit($id, $data)
    {
        $this->db->where('id_peralatan_pemanfaat_energi', $id);
        $this->db->update('t_peralatan_pemanfaat_energi', $data);
        return true;
    }

    public function del($id)
    {
        $this->db->where('id_peralatan_pemanfaat_energi', $id);
        $this->db->delete('t_peralatan_pemanfaat_energi');
        return true;
    }

    public function getJenisEnergi($idDetail)
    {
        $this->db->select('IdJenisEnergi')
            ->from('tm_jenisenergidetail')
            ->where('id_jenis_energi_detail', $idDetail);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('id_peralatan_pemanfaat_energi,  id_jenis_peralatan, JenisPeralatan, jenis_peralatan_lain, id_jenis_energi, jenis_energi_lain, original_unit, konversi, gjoule, tahun, id_perusahaan, status_audit, keterangan_audit, Satuan, file_audit,id_jenis_energi_detail, ruang_lingkup, bulan_pelaksanaan, tahun_pelaksanaan, nama_auditor, no_sertifikat_auditor')
            ->from('t_peralatan_pemanfaat_energi')
            ->join('tm_jenisperalatan', 't_peralatan_pemanfaat_energi.id_jenis_peralatan=tm_jenisperalatan.IdJenisPeralatan')
            ->join('tm_jenisenergi', 't_peralatan_pemanfaat_energi.id_jenis_energi=tm_jenisenergi.IdJenisEnergi')
            ->where('tahun', date("Y") - 1)
			->where('id_peralatan_pemanfaat_energi', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdpAndTahun($idp,$tahun)
    {
        $this->db->select('id_peralatan_pemanfaat_energi, id_jenis_peralatan, JenisPeralatan,  jenis_peralatan_lain, id_jenis_energi, jenis_energi_lain, original_unit, konversi, gjoule, tahun, id_perusahaan, status_audit, keterangan_audit, Satuan, file_audit,id_jenis_energi_detail')
            ->from('t_peralatan_pemanfaat_energi')
            ->join('tm_jenisperalatan', 't_peralatan_pemanfaat_energi.id_jenis_peralatan=tm_jenisperalatan.IdJenisPeralatan')
            ->join('tm_jenisenergi', 't_peralatan_pemanfaat_energi.id_jenis_energi=tm_jenisenergi.IdJenisEnergi')
            ->where('id_perusahaan', $idp)
            ->where('tahun', $tahun);
        $query = $this->db->get();
        return $query->result();
    }

    public function getOriginalUnitPeralatanDetail($id, $idp)
    {
        $this->db->select_sum('original_unit')
            ->where('id_jenis_energi_detail', $id)
            ->where('id_perusahaan', $idp)
            ->where('tahun', date("Y") - 1)
            ->from('t_peralatan_pemanfaat_energi');
        $query = $this->db->get();
        return $query->result();
    }

    public function getOriginalUnitPeralatanDetailIfEdit($id, $idp, $idalat)
    {
        $this->db->select_sum('original_unit')
            ->where('id_jenis_energi_detail', $id)
            ->where('id_perusahaan', $idp)
			->where('tahun', date("Y") - 1)
            ->where('id_peralatan_pemanfaat_energi != ', $idalat)
			->from('t_peralatan_pemanfaat_energi');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_fordropdowndetail($idp)
    {
        $this->db->select('a.id_peralatan_pemanfaat_energi, a.id_jenis_peralatan,a.jenis_peralatan_lain, b.JenisPeralatan, c.JenisEnergi, d.detail_jenis_energi');
        $this->db->from('t_peralatan_pemanfaat_energi AS a');// I use aliasing make joins easier
        $this->db->join('tm_jenisperalatan AS b', 'a.id_jenis_peralatan = b.IdJenisPeralatan', 'INNER');
        $this->db->join('tm_jenisenergi as c', 'a.id_jenis_energi = c.IdJenisEnergi', 'INNER');
        $this->db->join('tm_jenisenergidetail as d', 'a.id_jenis_energi_detail = d.id_jenis_energi_detail', 'INNER');
        $this->db->where('b.Deleted', '0');
		$this->db->where('a.tahun', date("Y") - 1);
        $this->db->where('a.id_perusahaan', $idp);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            if (!empty($id)) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
            return '';
        }

    }

    public function cekpersen($data, $idp, $tahunp)
    {
        $this->db->select('(((SELECT SUM(gjoule) FROM t_peralatan_pemanfaat_energi WHERE tahun=' . $tahunp . ' AND id_perusahaan=' . $idp . ')/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=' . $tahunp . ' AND id_perusahaan=' . $idp . ')) * 100) AS persentase');
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row_array();
            //return $query->num_rows();
        }

        //return $query->result();
    }
}
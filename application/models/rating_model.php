<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class rating_model extends CI_Model {
	
	public  function getById($idperusahaan, $tahun){
		$this->db->select('sts.tahun, sts.`tgllapor`, p.NamaPerusahaan, p.KotaKab, subs.NamaSubsektor, 
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS jumlahproduksi,
			(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS pemakaianenergi,
			((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)/
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)) AS konsumsienergispesifik,
			(SELECT SUM(realisasi_gjoule) FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS penghematan,
			org.OrgMgmntEnergi, org.MgrEnergi, org.NamaMgrEnergi, IF(LENGTH(org.NoSertMgrEnergi) > 0, 1, 0) AS MgrSertifikat, org.NoSertMgrEnergi,
			(SELECT 1 FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1) AS programkonservasi,
			(SELECT 1 FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1) AS audit,
			(SELECT 1 FROM t_rekomendasi_audit WHERE id_peralatan_pemanfaat_energi IN (SELECT id_peralatan_pemanfaat_energi FROM 
			t_peralatan_pemanfaat_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) LIMIT 1) AS rekomendasiaudit,
			sts.rating, sts.IdPerusahaan', false)
			->where('sts.`status`',2)
			->where('sts.`tahun`',$tahun)
			->where('sts.IdPerusahaan',$idperusahaan)
			->from('t_statussubmit AS sts ')
			->join('tm_perusahaan AS p','sts.IdPerusahaan=p.IdPerusahaan','inner')
			->join('tm_subsektor AS subs','p.IdSubsektor=subs.IdMSubsektor','inner')
			->join('t_orgmgrenergi AS org','org.IdPerusahaan=sts.`IdPerusahaan` AND org.tahun=sts.`tahun`','left');
		$query = $this->db->get();		
		return $query->result();
	}
	public function edit($idperusahaan, $tahun, $data)
	{
		$this->db->where('IdPerusahaan',$idperusahaan)
		->where('tahun',$tahun);
		$this->db->update('t_statussubmit',$data);		
		return true;
	}
}
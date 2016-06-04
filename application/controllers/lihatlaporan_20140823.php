<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lihatlaporan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('username') == ''){
			redirect('logout');
		}
		$this->data['menugroup'] = '1';
		$this->data['menugroup'] = '2';


		
		$this->load->model('typeperusahaan_model');
		$this->load->model('subsektor_model');
		$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		$this->load->model('perusahaan_model');
		$this->load->model('kegiatankonservasi_model');
		$this->load->model('peralatanpemanfaatenergi_model');
		$this->load->model('orgenergi_model');
		$this->load->model('lihatlaporan_model');
	}
	
	public function index()
	{
		if($this->session->userdata('id_perusahaan')!="")
		{
			$IdPerusahaanP =  $this->input->get('idp');
			$tahunP = $this->input->get('tahun');
			
			if($IdPerusahaanP==""){
				$idp = $this->session->userdata('id_perusahaan');
			}elseif($this->session->userdata('privilege_id')=="2"){
				$idp = $IdPerusahaanP;
			}else
			{
				$this->load->view('no_access', $this->data);
			}
			if($tahunP==""){
				$tahuncari= (date("Y")-1);
			}elseif($this->session->userdata('privilege_id')=="2"){
				$tahuncari=$tahunP;
			}else
			{
				$this->load->view('no_access', $this->data);
			}
			
			
			$this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
			$this->data['data_kegiatan'] = $this->kegiatankonservasi_model->get_fordropdowndetail();
			
				
			$querydata = $this->lihatlaporan_model->cekdataOrg($this->data,$idp,$tahuncari);
			$querydata1 = $this->lihatlaporan_model->cekdata($this->data,$idp,$tahuncari);
			$querydata2 = $this->lihatlaporan_model->countsubmit($this->data,$idp,$tahuncari);
			//status submit
			if($querydata2['submit_akhir']=='1')
			{	
				$this->data['submit_status'] = '1';
				
			}else
			{			
				$this->data['submit_status'] = '0';
			}
			
			//informasi umum		
			$this->data['idp']=$idp;
			$this->data['tahunp']=$tahuncari;
			$this->data['type_perusahaanp'] = $querydata1['TypePerusahaan'];
			$this->data['nama_perusahaanp'] = $querydata1['NamaPerusahaan'];
			$this->data['alamat_perusahaanp'] = $querydata1['AlamatPerusahaan'];
			$this->data['kotakabp'] = $querydata1['KotaKab'];
			$this->data['provp'] = $querydata1['Prov'];
			$this->data['NoTelpp'] = $querydata1['NoTelp'];
			$this->data['NoFaxp'] = $querydata1['NoFax'];
			$this->data['SubsektorLainp'] = $querydata1['SubsektorLain'];
			$this->data['ThnAwalOpp'] = $querydata1['ThnAwalOp'];
			$this->data['JmlKaryawanp'] = $querydata1['JmlKaryawan'];
			$this->data['NoFaxp'] = $querydata1['NoFax'];
			$this->data['NamaSubsektorp'] = $querydata1['NamaSubsektor'];
			//organisasi managemen energi
			$this->data['pathfilep'] = $querydata['PathFileOrg'];
			$this->data['pathfilesertifikatp'] = $querydata['PathFileSertifikat'];
			$this->data['emailmanagerp'] = $querydata['EmailMgrEnergi'];
			$this->data['namamanagerp'] = $querydata['NamaMgrEnergi'];
			$this->data['noteleponp'] = $querydata['NoTlpMgrEnergi'];
			$this->data['nosertifikatp'] = $querydata['NoSertMgrEnergi'];
			if($querydata['OrgMgmntEnergi'] == '1'){
				$this->data['organisasi'] = "Ada";
				
			}else{
				$this->data['organisasi'] = "Tidak Ada";
			}	
			if($querydata['MgrEnergi'] == '1'){
				$this->data['manager'] = "Ada";
			}else{
				$this->data['manager'] = "Tidak Ada";
			}
			$this->load->view('view_lihatlaporan', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
		
	}
	
	public function savesubmit()
	{
		$tahun = date("Y")-1;
		$id = $this->session->userdata('id_perusahaan');
		$this->db->trans_start();
		$this->db->from('t_statussubmit');
		$this->db->where('IdPerusahaan',$id);
		$this->db->where('tahun',$tahun);
		$count = $this->db->count_all_results();
		$this->db->trans_complete();
		
		
		if($count > 0){
		$data = array(
				'submit_akhir' => '1'
			);
		$this->lihatlaporan_model->edit($id,$data);		
		}else{		
			$data = array(
					'IdPerusahaan' => $id,
					'submit_akhir' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($data);		
		}
		
		redirect('lihatlaporan');
	
	}
	public function print2pdf()
	{
		if($this->session->userdata('id_perusahaan')!="")
		{
			$IdPerusahaanP =  $this->input->get('idp');
			$tahunP = $this->input->get('tahun');
			
			if($IdPerusahaanP==""){
				$idp = $this->session->userdata('id_perusahaan');
			}elseif($this->session->userdata('privilege_id')=="2"){
				$idp = $IdPerusahaanP;
			}else{
				$this->load->view('no_access', $this->data);
			}
			if($tahunP==""){
				$tahuncari= (date("Y")-1);
			}elseif($this->session->userdata('privilege_id')=="2"){
				$tahuncari=$tahunP;
			}else{
				$this->load->view('no_access', $this->data);
			}
			
			
			$this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
			$this->data['data_kegiatan'] = $this->kegiatankonservasi_model->get_fordropdowndetail();
			
				
			$querydata = $this->lihatlaporan_model->cekdataOrg($this->data,$idp,$tahuncari);
			$querydata1 = $this->lihatlaporan_model->cekdata($this->data,$idp,$tahuncari);
			$querydata2 = $this->lihatlaporan_model->countsubmit($this->data,$idp,$tahuncari);
			//status submit
			if($querydata2['submit_akhir']=='1'){	
				$this->data['submit_status'] = '1';				
			}else			{			
				$this->data['submit_status'] = '0';
			}
			
			
			//informasi umum		
			$this->data['idp']=$idp;
			$this->data['tahunp']=$tahuncari;
			$this->data['type_perusahaanp'] = $querydata1['TypePerusahaan'];
			$this->data['nama_perusahaanp'] = $querydata1['NamaPerusahaan'];
			$this->data['alamat_perusahaanp'] = $querydata1['AlamatPerusahaan'];
			$this->data['kotakabp'] = $querydata1['KotaKab'];
			$this->data['provp'] = $querydata1['Prov'];
			$this->data['NoTelpp'] = $querydata1['NoTelp'];
			$this->data['NoFaxp'] = $querydata1['NoFax'];
			$this->data['SubsektorLainp'] = $querydata1['SubsektorLain'];
			$this->data['ThnAwalOpp'] = $querydata1['ThnAwalOp'];
			$this->data['JmlKaryawanp'] = $querydata1['JmlKaryawan'];
			$this->data['NoFaxp'] = $querydata1['NoFax'];
			$this->data['NamaSubsektorp'] = $querydata1['NamaSubsektor'];
			//organisasi managemen energi
			$this->data['pathfilep'] = $querydata['PathFileOrg'];
			$this->data['pathfilesertifikatp'] = $querydata['PathFileSertifikat'];
			$this->data['emailmanagerp'] = $querydata['EmailMgrEnergi'];
			$this->data['namamanagerp'] = $querydata['NamaMgrEnergi'];
			$this->data['noteleponp'] = $querydata['NoTlpMgrEnergi'];
			$this->data['nosertifikatp'] = $querydata['NoSertMgrEnergi'];
			if($querydata['OrgMgmntEnergi'] == '1'){
				$this->data['organisasi'] = "Ada";
				
			}else{
				$this->data['organisasi'] = "Tidak Ada";
			}	
			if($querydata['MgrEnergi'] == '1'){
				$this->data['manager'] = "Ada";
			}else{
				$this->data['manager'] = "Tidak Ada";
			}
			
			//jenis produksi
			$this->data['tbjenisproduksi'] = $this->lihatlaporan_model->jenisproduksiLP($idp,$tahuncari);
			//luas bangunan
			$this->data['tbluasbangunan'] = $this->lihatlaporan_model->luasbangunanLP($idp,$tahuncari);
			//pemakaian energi
			$this->data['tbpemakaianenergi'] = $this->lihatlaporan_model->pemakaianenergiLP($idp,$tahuncari);
			//peralatanpemanfaatenergi
			$this->data['tbperalatanpemanfaatenergi'] = $this->lihatlaporan_model->peralatanpemanfaatenergiLP($idp,$tahuncari);
			//kegiatankonservasi
			$this->data['tbkegiatankonservasi'] = $this->lihatlaporan_model->kegiatankonservasiLP($idp,$tahuncari);
			//kegiatankonservasilain
			$this->data['tbkegiatankonservasilain'] = $this->lihatlaporan_model->kegiatankonservasilainLP($idp,$tahuncari);
			//rencanakonservasi
			$this->data['tbrencanakonservasi'] = $this->lihatlaporan_model->rencanakonservasiLP($idp,$tahuncari);
			//rencanakonservasilain
			$this->data['tbrencanakonservasilain'] = $this->lihatlaporan_model->rencanakonservasilainLP($idp,$tahuncari);
			//audit
			$this->data['tbaudit'] = $this->lihatlaporan_model->auditLP($idp,$tahuncari);
			//konsumsienergispesifikLP
			if($querydata1['TypePerusahaan']=='Industri'){
			$this->data['tbakonsumsienergispesifik'] = $this->lihatlaporan_model->konsumsienergispesifikLP($idp,$tahuncari);
			}
			elseif($querydata1['TypePerusahaan']=='Bangunan'){
			$this->data['tbakonsumsienergispesifik'] = $this->lihatlaporan_model->konsumsienergispesifikbangLP($idp,$tahuncari);
			}
			
			ini_set('memory_limit','48M'); 
			$html = $this->load->view('print_lihatlaporan', $this->data, true); // render the view into HTML
			//$this->load->view('print_lihatlaporan', $this->data);
			//ob_clean(); 
			$this->load->helper(array('pdf_lihatlaporan'));   //  Load helper
			create_pdf($html,"laporan managemen energi ".$querydata1['NamaPerusahaan']." tahun ".$tahuncari ); //Create pdf
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
		  
	}
	
	public function print2pdf1()
	{
			$IdPerusahaanP =  $this->input->get('idp');
			$tahunP = $this->input->get('tahun');
			
			if($IdPerusahaanP==""){
				$idp = $this->session->userdata('id_perusahaan');
			}elseif($this->session->userdata('privilege_id')=="2"){
				$idp = $IdPerusahaanP;
			}else
			{
				$this->load->view('no_access', $this->data);
			}
			if($tahunP==""){
				$tahuncari= (date("Y")-1);
			}elseif($this->session->userdata('privilege_id')=="2"){
				$tahuncari=$tahunP;
			}else
			{
				$this->load->view('no_access', $this->data);
			}
			
		$this->load->helpers('pdfLihatLaporan');
		$pdf = new PDF();
		
		$querydata = $this->lihatlaporan_model->cekdataOrg($this->data,$idp,$tahuncari);
		$querydata1 = $this->lihatlaporan_model->cekdata($this->data,$idp,$tahuncari);
		
		if($querydata['OrgMgmntEnergi'] == '1'){
			$organisasi = "Ada";
			
		}else{
			$organisasi = "Tidak Ada";
		}	
		if($querydata['MgrEnergi'] == '1'){
			$MgrEnergi = "Ada";
		}else{
			$MgrEnergi = "Tidak Ada";
		}
		
		$datainfo = array(
						array('Nama Perusahaan',': '.$querydata1['NamaPerusahaan']),
						array('Type Perusahaan',': '.$querydata1['TypePerusahaan']),
						array('NamaSubsektor' , ': '.$querydata1['NamaSubsektor']),
						array('Sub sektor Lain' , ': '.$querydata1['SubsektorLain']),
						array('Alamat Perusahaan',': '.$querydata1['AlamatPerusahaan']),
						array('    Kota/Kab' , ': '.$querydata1['KotaKab']),
						array('    Provinsi' , ': '.$querydata1['Prov']),
						array('No Telp' , ': '.$querydata1['NoTelp']),
						array('No Fax' , ': '.$querydata1['NoFax']),						
						array('Thn Awal Operational' , ': '.$querydata1['ThnAwalOp']),
						array('Jumlah Karyawan' , ': '.$querydata1['JmlKaryawan'])
					);
		$dataorg = array(
						array('Ada/Tidak Organisasi Energi ' , ': '.$organisasi),
						array('    File Struktur Organisasi ' , ': '.$querydata['PathFileOrg']),
						array('Ada/Tidak Manager Energi ' , ': '.$MgrEnergi),
						array('pathfilesertifikat' , ': '.$querydata['PathFileSertifikat']),
						array('emailmanager' , ': '.$querydata['EmailMgrEnergi']),
						array('namamanager' , ': '.$querydata['NamaMgrEnergi']),
						array('notelepon' , ': '.$querydata['NoTlpMgrEnergi']),
						array('nosertifikat' , ': '.$querydata['NoSertMgrEnergi']),
						
						
		);
		
		
		$header = array('start','Name');
		//First page
		  $pdf->AddPage();
		  $pdf->SetLeftMargin(20);
		  $pdf->SetReportFirstPageHead(base_url().'img/logo.png','Laporan Managemen Energi tahun '.(date("Y")-1) , date('F j, Y'), '',$datainfo);
		  $pdf->Tableinfo($header,$datainfo);
		  $pdf->TableOrg($header,$dataorg);
		  
		  $pdf->Output();
	}
	
	//para list
	function listjenisproduksi(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		
		$this->datatables->select('c.NamaSubsektor,jenis_produksi, jumlah, satuan, id_jenis_produksi', false)
			->from('t_jenis_produksi AS a')
			->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
			->join('tm_subsektor AS c','b.IdSubsektor=c.IdMSubsektor')
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun);

		echo $this->datatables->generate();		
	}
	function listluasbangunan(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('c.NamaSubsektor,nama_bangunan, luas_bangunan, id_luas_bangunan', false)
			->from('t_luas_bangunan AS a')
			->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
			->join('tm_subsektor AS c','b.IdSubsektor=c.IdMSubsektor')
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun);

		echo $this->datatables->generate();
	}
	function listpemakaianenergi(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('b.JenisEnergi as JenisEnergi, c.detail_jenis_energi as detail_jenis_energi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_pemakaian_energi as id_pemakaian_energi, b.Satuan AS Satuan', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_pemakaian_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi','INNER')
			->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail=c.id_jenis_energi_detail','INNER');
		echo $this->datatables->generate();
	}
	function listperalatanpemanfaatenergi(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, d.detail_jenis_energi as detail_jenis_energi,b.JenisEnergi as JenisEnergi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, b.Satuan AS Satuan, ((a.gjoule/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun='.$tahun.' AND id_perusahaan='.$id_perusahaan.')) * 100) AS persentase', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
			->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan')
			->join('tm_jenisenergidetail AS d', 'a.id_jenis_energi_detail=d.id_jenis_energi_detail');
			
		echo $this->datatables->generate();
	}
	function listkegiatankonservasi(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('kegiatan, faktor_emisi, realisasi_gjoule, realisasi_persen, realisasi_emisi, realisasi_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, a.konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi,b.jenis_peralatan_lain')
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_kegiatan_konservasi_new as a')
			->join('t_peralatan_pemanfaat_energi AS b', 'a.id_peralatan_pemanfaat_energi = b.id_peralatan_pemanfaat_energi', 'INNER');
			
		echo $this->datatables->generate();
	}
	function listkegiatankonservasilain(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi_lain')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_kegiatan_konservasi_lain');
			
		echo $this->datatables->generate();
	}
	function listrencanakonservasi(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('kegiatan, faktor_emisi, target_gjoule, target_persen, target_emisi, target_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_rencana_konservasi_new as a');
			
		echo $this->datatables->generate();
	}
	function listrencanakonservasilain(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi_lain')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_rencana_konservasi_lain');
			
		echo $this->datatables->generate();
	}
	function listaudit(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y")-1;
		}
		
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit, a.keterangan_audit, a.file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		echo $this->datatables->generate();
	}
	function listkonsumsienergispesifik(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y");
		}
		$this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
			->where('id_perusahaan = '.$id_perusahaan)
			->from('vkons_energi_spesifik');
		echo $this->datatables->generate();
	}
	function listkonsumsienergispesifikbang(){
		$id_perusahaan	= $this->input->get('idp', TRUE);
		$tahun = $this->input->get('tahunp', TRUE);
		if($id_perusahaan==""){
		$id_perusahaan = $this->session->userdata('id_perusahaan');			
		}		
		if($tahun==""){
		$tahun = date("Y");
		}
		$this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
			->where('id_perusahaan = '.$id_perusahaan)
			->from('vkons_energi_spesifik_bang');
		echo $this->datatables->generate();
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
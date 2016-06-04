<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class lihatlaporan extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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

        if ($this->session->userdata('username') == '') {
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
        $this->load->model('lihatlaporan_model');
    }

    public function index()
    {
        if ($this->session->userdata('id_perusahaan') != "") {
            $IdPerusahaanP = $this->input->get('idp');

            $tahunP = $this->input->get('tahun');

            if ($IdPerusahaanP == "") {
                $idp = $this->session->userdata('id_perusahaan');
            } elseif ($this->session->userdata('privilege_id') == "2") {
                $idp = $IdPerusahaanP;
            } else {
                $this->load->view('no_access', $this->data);
            }
            if ($tahunP == "") {
                $tahuncari = (date("Y") - 1);
            } elseif ($this->session->userdata('privilege_id') == "2") {
                $tahuncari = $tahunP;
            } else {
                $this->load->view('no_access', $this->data);
            }


            $this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
            $this->data['data_kegiatan'] = $this->kegiatankonservasi_model->get_fordropdowndetail();
            $statusp = $this->perusahaan_model->getstatusbyidp($idp);
            $this->data['statusp'] = $statusp['status'];

            $querydata = $this->lihatlaporan_model->cekdataOrg($this->data, $idp, $tahuncari);
            $querydata1 = $this->lihatlaporan_model->cekdata($this->data, $idp, $tahuncari);
            $querydata2 = $this->lihatlaporan_model->countsubmit($this->data, $idp, $tahuncari);
            //status submit
            if ($querydata2['submit_akhir'] == '1') {
                $this->data['submit_status'] = '1';

            } else {
                $this->data['submit_status'] = '0';
            }

            //informasi umum
            $this->data['idp'] = $idp;
            $this->data['tahunp'] = $tahuncari;
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
            $this->data['pathfilekebijakanp'] = $querydata['PathFileKbjk'];
            $this->data['pathfilesertifikatp'] = $querydata['PathFileSertifikat'];
            $this->data['emailmanagerp'] = $querydata['EmailMgrEnergi'];
            $this->data['namamanagerp'] = $querydata['NamaMgrEnergi'];
            if (is_null($querydata['JabatanManajerEnergi']) == true) {
                $this->data['jabatanmanagerp'] = "-";
            } else {
                $this->data['jabatanmanagerp'] = $querydata['JabatanManajerEnergi'];
            }
            $this->data['detailjabatanmanagerp'] = $querydata['DetailJab'];
            $this->data['noteleponp'] = $querydata['NoTlpMgrEnergi'];
            $this->data['nosertifikatp'] = $querydata['NoSertMgrEnergi'];
            if ($querydata['OrgMgmntEnergi'] == '1') {
                $this->data['organisasi'] = "Ada";

            } else {
                $this->data['organisasi'] = "Tidak Ada";
            }
            if ($querydata['KebijakanEnergi'] == '1') {
                $this->data['kebijakan'] = "Ada";

            } else {
                $this->data['kebijakan'] = "Tidak Ada";
            }
            if ($querydata['MgrEnergi'] == '1') {
                $this->data['manager'] = "Ada";
            } else {
                $this->data['manager'] = "Tidak Ada";
            }
            $this->load->view('view_lihatlaporan', $this->data);

        } else {
            $this->load->view('no_access', $this->data);
        }

    }

    public function statusp()
    {
        $idp = $this->input->get('idp');
        $tahunp = $this->input->get('tahun');
        $statusp = $this->input->get('statusp');
        $this->perusahaan_model->UpdateStatusPerusahaan($idp, $tahunp, $statusp);
        $url = base_url() . "lihatlaporan?idp=$idp&tahun=$tahunp";
        redirect($url);
    }

    public function savesubmit()
    {
        $tahun = date("Y") - 1;
        $id = $this->session->userdata('id_perusahaan');
        $this->db->trans_start();
        $this->db->from('t_statussubmit');
        $this->db->where('IdPerusahaan', $id);
        $this->db->where('tahun', $tahun);
        $count = $this->db->count_all_results();
        $this->db->trans_complete();


        if ($count > 0) {
            $data = array(
                'submit_akhir' => '1','status' => '1'
            );
            $this->lihatlaporan_model->edit($id, $data);
        } else {
            $data = array(
                'IdPerusahaan' => $id,
                'submit_akhir' => '1',
                'status' => '1',
                'tahun' => date("Y") - 1
            );
            $this->lihatlaporan_model->insert($data);
        }

        redirect('lihatlaporan');

    }

    public function toxls()
    {
        $IdPerusahaanP = $this->input->get('idp');
        $tahunP = $this->input->get('tahun');
        if ($IdPerusahaanP == "") {
            $idp = $this->session->userdata('id_perusahaan');
        } elseif ($this->session->userdata('privilege_id') == "2") {
            $idp = $IdPerusahaanP;
        } else {
            $this->load->view('no_access', $this->data);
        }
        if ($tahunP == "") {
            $tahuncari = (date("Y") - 1);
        } elseif ($this->session->userdata('privilege_id') == "2") {
            $tahuncari = $tahunP;
        } else {
            $this->load->view('no_access', $this->data);
        }


    }

    public function print2pdf()
    {
        if ($this->session->userdata('id_perusahaan') != "") {
            $IdPerusahaanP = $this->input->get('idp');
            $tahunP = $this->input->get('tahun');
            $printP = $this->input->get('print');

            if ($IdPerusahaanP == "") {
                $idp = $this->session->userdata('id_perusahaan');
            } elseif ($this->session->userdata('privilege_id') == "2") {
                $idp = $IdPerusahaanP;
            } else {
                $this->load->view('no_access', $this->data);
            }
            if ($tahunP == "") {
                $tahuncari = (date("Y") - 1);
            } elseif ($this->session->userdata('privilege_id') == "2") {
                $tahuncari = $tahunP;
            } else {
                $this->load->view('no_access', $this->data);
            }


            $this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
            $this->data['data_kegiatan'] = $this->kegiatankonservasi_model->get_fordropdowndetail();


            $querydata = $this->lihatlaporan_model->cekdataOrg($this->data, $idp, $tahuncari);
            $querydata1 = $this->lihatlaporan_model->cekdata($this->data, $idp, $tahuncari);
            $querydata2 = $this->lihatlaporan_model->countsubmit($this->data, $idp, $tahuncari);
            //status submit
            if ($querydata2['submit_akhir'] == '1') {
                $this->data['submit_status'] = '1';
            } else {
                $this->data['submit_status'] = '0';
            }


            //informasi umum
            $this->data['idp'] = $idp;
            $this->data['tahunp'] = $tahuncari;
            $type_perusahaanp = $querydata1['TypePerusahaan'];
            $namaperusahaanP = $querydata1['NamaPerusahaan'];
            $alamat_perusahaanp = $querydata1['AlamatPerusahaan'];
            $kotakabp = $querydata1['KotaKab'];
            $provp = $querydata1['Prov'];
            $NoTelpp = $querydata1['NoTelp'];
            $NoFaxp = $querydata1['NoFax'];
            $SubsektorLainp = $querydata1['SubsektorLain'];
            $ThnAwalOpp = $querydata1['ThnAwalOp'];
            $JmlKaryawanp = $querydata1['JmlKaryawan'];
            $NoFaxp = $querydata1['NoFax'];
            $NamaSubsektorp = $querydata1['NamaSubsektor'];

            $this->data['type_perusahaanp'] = $type_perusahaanp;
            $this->data['nama_perusahaanp'] = $namaperusahaanP;
            $this->data['alamat_perusahaanp'] = $alamat_perusahaanp;
            $this->data['kotakabp'] = $kotakabp;
            $this->data['provp'] = $provp;
            $this->data['NoTelpp'] = $NoTelpp;
            $this->data['NoFaxp'] = $NoFaxp;
            $this->data['SubsektorLainp'] = $SubsektorLainp;
            $this->data['ThnAwalOpp'] = $ThnAwalOpp;
            $this->data['JmlKaryawanp'] = $JmlKaryawanp;
            $this->data['NoFaxp'] = $NoFaxp;
            $this->data['NamaSubsektorp'] = $NamaSubsektorp;
            //organisasi managemen energi
            $this->data['pathfilep'] = $querydata['PathFileOrg'];
            $this->data['pathfilekebijakanp'] = $querydata['PathFileKbjk'];
            $this->data['pathfilesertifikatp'] = $querydata['PathFileSertifikat'];
            if (is_null($querydata['JabatanManajerEnergi']) == true) {
                $this->data['jabatanmanagerp'] = "-";
            } else {
                $this->data['jabatanmanagerp'] = $querydata['JabatanManajerEnergi'];
            }
            $this->data['detailjabatanmanagerp'] = $querydata['DetailJab'];

            $this->data['emailmanagerp'] = $querydata['EmailMgrEnergi'];
            $this->data['namamanagerp'] = $querydata['NamaMgrEnergi'];
            $this->data['noteleponp'] = $querydata['NoTlpMgrEnergi'];
            $this->data['nosertifikatp'] = $querydata['NoSertMgrEnergi'];
            if ($querydata['OrgMgmntEnergi'] == '1') {
                $this->data['organisasi'] = "Ada";

            } else {
                $this->data['organisasi'] = "Tidak Ada";
            }
            if ($querydata['KebijakanEnergi'] == '1') {
                $this->data['kebijakan'] = "Ada";

            } else {
                $this->data['kebijakan'] = "Tidak Ada";
            }
            if ($querydata['MgrEnergi'] == '1') {
                $this->data['manager'] = "Ada";
            } else {
                $this->data['manager'] = "Tidak Ada";
            }

            //jenis produksi
            $this->data['tbjenisproduksi'] = $this->lihatlaporan_model->jenisproduksiLP($idp, $tahuncari);
            //luas bangunan
            $this->data['tbluasbangunan'] = $this->lihatlaporan_model->luasbangunanLP($idp, $tahuncari);
            //pemakaian energi
            $this->data['tbpemakaianenergi'] = $this->lihatlaporan_model->pemakaianenergiLP($idp, $tahuncari);
            $this->data['tbpemakaianenergitotal'] = $this->lihatlaporan_model->pemakaianenergitotalLP($idp, $tahuncari);
            //peralatanpemanfaatenergi
            $this->data['tbperalatanpemanfaatenergi'] = $this->lihatlaporan_model->peralatanpemanfaatenergiLP($idp, $tahuncari);
            $this->data['tbperalatanpemanfaatenergitotal'] = $this->lihatlaporan_model->peralatanpemanfaatenergitotalLP($idp, $tahuncari);
            //kegiatankonservasi
            $this->data['tbkegiatankonservasi'] = $this->lihatlaporan_model->kegiatankonservasiLP($idp, $tahuncari);
            //kegiatankonservasilain
            $this->data['tbkegiatankonservasilain'] = $this->lihatlaporan_model->kegiatankonservasilainLP($idp, $tahuncari);
            //rencanakonservasi
            $this->data['tbrencanakonservasi'] = $this->lihatlaporan_model->rencanakonservasiLP($idp, $tahuncari);
            //rencanakonservasilain
            $this->data['tbrencanakonservasilain'] = $this->lihatlaporan_model->rencanakonservasilainLP($idp, $tahuncari);
            //audit
            $this->data['tbaudit'] = $this->lihatlaporan_model->auditLP($idp, $tahuncari);
			$this->data['tbaudit1'] = $this->lihatlaporan_model->auditLP1($idp, $tahuncari);
            //raudit
            $this->data['tbraudit'] = $this->lihatlaporan_model->rekauditLP($idp, $tahuncari);

            //konsumsienergispesifikLP
            if ($querydata1['TypePerusahaan'] == 'Industri') {
                $this->data['tbakonsumsienergispesifik'] = $this->lihatlaporan_model->konsumsienergispesifikLP($idp, $tahuncari);
            } elseif ($querydata1['TypePerusahaan'] == 'Bangunan') {
                $this->data['tbakonsumsienergispesifik'] = $this->lihatlaporan_model->konsumsienergispesifikbangLP($idp, $tahuncari);
            }

            if ($printP == 'pdf') {
                $this->load->view('print_lihatlaporan', $this->data);

                ini_set('memory_limit', '48M');
                $html = $this->load->view('print_lihatlaporan', $this->data, true); // render the view into HTML
                $this->load->helper(array('pdf_lihatlaporan'));   //  Load helper
                //create_pdf($html,"laporan managemen energi ".$querydata1['NamaPerusahaan']." tahun ".$tahuncari ); //Create pdf
            } elseif ($printP == 'xls') {
                $this->load->library('excel1');
                // informasi umum
                $this->excel1->setActiveSheetIndex(0);
                $this->excel1->getActiveSheet()->setTitle('Informasi Umum');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Informasi Umum');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Nama Perusahaan');
                $this->excel1->getActiveSheet()->setCellValue('B3', ':');
                $this->excel1->getActiveSheet()->setCellValue('B3', $namaperusahaanP);
                $this->excel1->getActiveSheet()->setCellValue('A4', 'Type Perusahaan');
                $this->excel1->getActiveSheet()->setCellValue('B4', ':');
                $this->excel1->getActiveSheet()->setCellValue('B4', $type_perusahaanp);
                $this->excel1->getActiveSheet()->setCellValue('A5', 'Sub Sektor');
                $this->excel1->getActiveSheet()->setCellValue('B5', ':');
                $this->excel1->getActiveSheet()->setCellValue('B5', $SubsektorLainp);
                $this->excel1->getActiveSheet()->setCellValue('A6', 'Alamat Perusahaan');
                $this->excel1->getActiveSheet()->setCellValue('B6', ':');
                $this->excel1->getActiveSheet()->setCellValue('B6', $alamat_perusahaanp);
                $this->excel1->getActiveSheet()->setCellValue('A7', 'Provinsi');
                $this->excel1->getActiveSheet()->setCellValue('B7', ':');
                $this->excel1->getActiveSheet()->setCellValue('B7', $provp);
                $this->excel1->getActiveSheet()->setCellValue('A8', 'Kota / Kabupaten');
                $this->excel1->getActiveSheet()->setCellValue('B8', ':');
                $this->excel1->getActiveSheet()->setCellValue('B8', $kotakabp);
                $this->excel1->getActiveSheet()->setCellValue('A9', 'No Telepon');
                $this->excel1->getActiveSheet()->setCellValue('B9', ':');
                $this->excel1->getActiveSheet()->setCellValue('B9', $NoTelpp);
                $this->excel1->getActiveSheet()->setCellValue('A10', 'No Faximili');
                $this->excel1->getActiveSheet()->setCellValue('B10', ':');
                $this->excel1->getActiveSheet()->setCellValue('B10', $NoFaxp);
                $this->excel1->getActiveSheet()->setCellValue('A11', 'Tahun Awal Beroperasi');
                $this->excel1->getActiveSheet()->setCellValue('B11', ':');
                $this->excel1->getActiveSheet()->setCellValue('B11', $ThnAwalOpp);
                $this->excel1->getActiveSheet()->setCellValue('A12', 'Jumlah Karyawan');
                $this->excel1->getActiveSheet()->setCellValue('B12', ':');
                $this->excel1->getActiveSheet()->setCellValue('B12', $JmlKaryawanp);


                //Organisasi Manajemen Energi
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(1);
                $this->excel1->getActiveSheet()->setTitle('Organisasi Manajemen Energi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Organisasi Manajemen Energi');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'ada/tidak Kebijakan Efisiensi Energi Perusahaan');
                $this->excel1->getActiveSheet()->setCellValue('B3', ':');
                $this->excel1->getActiveSheet()->setCellValue('C3', $this->data['kebijakan']);
                $this->excel1->getActiveSheet()->setCellValue('A4', 'Ada/Tidak Organisasi Manajemen Energi');
                $this->excel1->getActiveSheet()->setCellValue('B4', ':');
                $this->excel1->getActiveSheet()->setCellValue('C4', $this->data['organisasi']);
                $this->excel1->getActiveSheet()->setCellValue('A5', 'Jabatan Manajer Energi');
                $this->excel1->getActiveSheet()->setCellValue('B5', ':');
                $this->excel1->getActiveSheet()->setCellValue('C5', $this->data['jabatanmanagerp']);
                $this->excel1->getActiveSheet()->setCellValue('A6', 'Nama Manajer Energi');
                $this->excel1->getActiveSheet()->setCellValue('B6', ':');
                $this->excel1->getActiveSheet()->setCellValue('C6', $this->data['namamanagerp']);
                $this->excel1->getActiveSheet()->setCellValue('A7', 'Detail Jabatan');
                $this->excel1->getActiveSheet()->setCellValue('B7', ':');
                $this->excel1->getActiveSheet()->setCellValue('C7', $this->data['detailjabatanmanagerp']);
                $this->excel1->getActiveSheet()->setCellValue('A8', 'Email Manajer Energi');
                $this->excel1->getActiveSheet()->setCellValue('B8', ':');
                $this->excel1->getActiveSheet()->setCellValue('C8', $this->data['emailmanagerp']);
                $this->excel1->getActiveSheet()->setCellValue('A9', 'No Telp / HP Manajer Energi');
                $this->excel1->getActiveSheet()->setCellValue('B9', ':');
                $this->excel1->getActiveSheet()->setCellValue('C9', $this->data['noteleponp']);
                $this->excel1->getActiveSheet()->setCellValue('A10', 'No Sertifikat');
                $this->excel1->getActiveSheet()->setCellValue('B10', ':');
                $this->excel1->getActiveSheet()->setCellValue('C10', $this->data['nosertifikatp']);


                //Jenis Produksi
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(2);
                if ($this->data['type_perusahaanp'] == "Industri") {
                    $this->excel1->getActiveSheet()->setTitle('Jenis Produksi');
                    $this->excel1->getActiveSheet()->setCellValue('A1', 'Jenis Produksi');
                    $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                    $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                    $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $this->excel1->getActiveSheet()->setCellValue('A3', 'Subsektor');
                    $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->setCellValue('B3', 'Jenis Produksi');
                    $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->setCellValue('C3', 'Jumlah');
                    $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->mergeCells('C3:D3');
                    $this->excel1->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $tbjenisproduksi = $this->data['tbjenisproduksi'];
                    $itungan = 4;
                    $A = 'A';
                    $B = 'B';
                    $C = 'C';
                    $D = 'D';
                    foreach ($tbjenisproduksi as $row) {
                        $A = 'A' . $itungan;
                        $B = 'B' . $itungan;
                        $C = 'C' . $itungan;
                        $D = 'D' . $itungan;
                        $this->excel1->getActiveSheet()->setCellValue($A, $row->NamaSubsektor);
                        $this->excel1->getActiveSheet()->setCellValue($B, $row->jenis_produksi);
                        $this->excel1->getActiveSheet()->setCellValue($C, $row->jumlah);
                        $this->excel1->getActiveSheet()->setCellValue($D, $row->satuan);
                        $itungan = $itungan + 1;

                    }
                    $this->excel1->getActiveSheet()->setCellValue('A' . $itungan, 'Total');
                    $this->excel1->getActiveSheet()->setCellValue('B' . $itungan, ':');
                    $this->excel1->getActiveSheet()->setCellValue('C' . $itungan, "=SUM(C4:$C)");

                } elseif ($this->data['type_perusahaanp'] == "Bangunan") {
                    $this->excel1->getActiveSheet()->setTitle('Luas Bangunan');
                    $this->excel1->getActiveSheet()->setCellValue('A1', 'Luas Bangunan');
                    $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                    $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                    $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $this->excel1->getActiveSheet()->setCellValue('A3', 'Subsektor');
                    $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->setCellValue('B3', 'Nama Bagunan');
                    $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->setCellValue('C3', 'Luas Bangunan');
                    $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                    $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                    $this->excel1->getActiveSheet()->mergeCells('C3:D3');
                    $this->excel1->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $tbluasbangunan = $this->data['tbluasbangunan'];
                    $itungan = 4;
                    $A = 'A';
                    $B = 'B';
                    $C = 'C';
                    $D = 'D';
                    foreach ($tbluasbangunan as $row) {

                        $A = 'A' . $itungan;
                        $B = 'B' . $itungan;
                        $C = 'C' . $itungan;

                        $this->excel1->getActiveSheet()->setCellValue($A, $row->NamaSubsektor);
                        $this->excel1->getActiveSheet()->setCellValue($B, $row->jenis_produksi);
                        $this->excel1->getActiveSheet()->setCellValue($C, $row->jumlah);
                        $this->excel1->getActiveSheet()->setCellValue($D, $row->satuan);
                        $itungan = $itungan + 1;
                    }
                    $this->excel1->getActiveSheet()->setCellValue('A' . $itungan, 'Total');
                    $this->excel1->getActiveSheet()->setCellValue('B' . $itungan, ':');
                    $this->excel1->getActiveSheet()->setCellValue('C' . $itungan, "=SUM(C4:$C)");
                }

                //Pemakaian Energi
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(3);
                $this->excel1->getActiveSheet()->setTitle('Pemakaian Energi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Pemakaian Energi');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Jenis Energi');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Detail Jenis Energi');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Original Unit');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'GJoule');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E3', 'Emisi (TCO2)');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

                $tbpemakaianenergi = $this->data['tbpemakaianenergi'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                Foreach ($tbpemakaianenergi as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;

                    $this->excel1->getActiveSheet()->setCellValue($A, $row->JenisEnergi);
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->detail_jenis_energi);
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->original_unit . " " . $row->Satuan);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->gjoule);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->emisi);

                    $itungan = $itungan + 1;
                }
                $this->excel1->getActiveSheet()->setCellValue('A' . $itungan, 'Total');
                $this->excel1->getActiveSheet()->mergeCells('A' . $itungan . ':' . 'C' . $itungan);
                $this->excel1->getActiveSheet()->getStyle('A' . $itungan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel1->getActiveSheet()->setCellValue('D' . $itungan, "=SUM(D4:$D)");
                $this->excel1->getActiveSheet()->setCellValue('E' . $itungan, "=SUM(E4:$E)");

                //Konsumsi Energi Spesifik
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(4);
                $this->excel1->getActiveSheet()->setTitle('Konsumsi Energi Spesifik');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Konsumsi Energi Spesifik');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', '');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Satuan');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Tahun Sebelumnya');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'Tahun ' . $tahunP);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E3', 'Persentase Pertumbuhan');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

                $tbakonsumsienergispesifik = $this->data['tbakonsumsienergispesifik'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                foreach ($tbakonsumsienergispesifik as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->keterangan);
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->satuan);
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->tahun_sebelum);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->tahun_ini);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->pertumbuhan);

                    $itungan = $itungan + 1;
                }

                //Peralatan Pemanfaat Energi Utama
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(5);
                $this->excel1->getActiveSheet()->setTitle('Peralatan Pemanfaat Energi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Peralatan Pemanfaat Energi Utama');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Jenis Peralatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Jenis Energi');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Original Unit');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'GJoule');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E3', 'Persentase Pemakaian Energi');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

                $tbperalatanpemanfaatenergi = $this->data['tbperalatanpemanfaatenergi'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                foreach ($tbperalatanpemanfaatenergi as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->jenis_peralatan . " (" . $row->jenis_peralatan_lain . ")");
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->detail_jenis_energi . " (" . $row->JenisEnergi . ")");
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->original_unit . " " . $row->Satuan);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->gjoule);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->persentase);

                    $itungan = $itungan + 1;
                }
                $this->excel1->getActiveSheet()->setCellValue('A' . $itungan, 'Total');
                $this->excel1->getActiveSheet()->mergeCells('A' . $itungan . ':' . 'C' . $itungan);
                $this->excel1->getActiveSheet()->getStyle('A' . $itungan)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel1->getActiveSheet()->setCellValue('D' . $itungan, "=SUM(D4:$D)");
                $this->excel1->getActiveSheet()->setCellValue('E' . $itungan, "=SUM(E4:$E)");

                //Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(6);
                $this->excel1->getActiveSheet()->setTitle('Kegiatan Efisiensi Energi ');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:G1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Peralatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A3:A4');
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('B3:B4');
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Detail Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('C3:C4');
                $this->excel1->getActiveSheet()->setCellValue('D3', 'Penghematan yang Diperoleh');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('D3:F3');
                $this->excel1->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel1->getActiveSheet()->setCellValue('D4', 'GJoule');
                $this->excel1->getActiveSheet()->getStyle('D4')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E4', '%');
                $this->excel1->getActiveSheet()->getStyle('E4')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('F4', 'Emisi tCO2');
                $this->excel1->getActiveSheet()->getStyle('F4')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('G3', 'Keterangan');
                $this->excel1->getActiveSheet()->getStyle('G3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('G3:G4');

                $tbkegiatankonservasi = $this->data['tbkegiatankonservasi'];
                $itungan = 5;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                $F = 'F';
                $G = 'G';
                foreach ($tbkegiatankonservasi as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;
                    $F = 'F' . $itungan;
                    $G = 'G' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->JenisPeralatan . " (" . $row->detail_jenis_energi . " - " . $row->JenisEnergi . ")");
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->jenis_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->detail_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->realisasi_gjoule);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->realisasi_persen);
                    $this->excel1->getActiveSheet()->setCellValue($F, $row->realisasi_emisi);
                    $this->excel1->getActiveSheet()->setCellValue($G, $row->keterangan);

                    $itungan = $itungan + 1;
                }

                //Kegiatan Efisiensi Lain
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(7);
                $this->excel1->getActiveSheet()->setTitle('Kegiatan Efisiensi Lain');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Kegiatan Efisiensi Lain');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Detail Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

                $tbkegiatankonservasilain = $this->data['tbkegiatankonservasilain'];
                $itungan = 5;
                $A = 'A';
                $B = 'B';
                foreach ($tbkegiatankonservasilain as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->jenis_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->detail_kegiatan);

                    $itungan = $itungan + 1;
                }


                //Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(8);
                $this->excel1->getActiveSheet()->setTitle('Rencana Kegiatan Efisiensi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Jenis Peralatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Jenis Energi');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Original Unit');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'GJoule');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E3', 'Persentase Pemakaian Energi');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

                $tbrencanakonservasi = $this->data['tbrencanakonservasi'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                $F = 'F';
                $G = 'G';
                foreach ($tbrencanakonservasi as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;
                    $F = 'F' . $itungan;
                    $G = 'G' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->JenisPeralatan . " (" . $row->detail_jenis_energi . " - " . $row->JenisEnergi . ")");
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->jenis_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->detail_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->target_gjoule);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->target_persen);
                    $this->excel1->getActiveSheet()->setCellValue($F, $row->target_emisi);
                    $this->excel1->getActiveSheet()->setCellValue($G, $row->keterangan);

                    $itungan = $itungan + 1;
                }

                //Rencana Kegiatan Efisiensi Lain
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(9);
                $this->excel1->getActiveSheet()->setTitle('Rencana Efisiensi Lain');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Rencana Kegiatan Efisiensi Lain');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Detail Kegiatan');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

                $tbrencanakonservasilain = $this->data['tbrencanakonservasilain'];
                $itungan = 5;
                $A = 'A';
                $B = 'B';
                foreach ($tbrencanakonservasilain as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->jenis_kegiatan);
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->detail_kegiatan);

                    $itungan = $itungan + 1;
                }

                //Audit Energi Pada Peralatan Pemanfaat Energi Utama
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(10);
                $this->excel1->getActiveSheet()->setTitle('Audit Energi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Audit Energi Pada Peralatan Pemanfaat Energi Utama');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Jenis Peralatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Status');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Ruang Lingkup');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'Bulan-Tahun Pelaksanaan');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
				$this->excel1->getActiveSheet()->setCellValue('E3', 'Nama Auditor');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
				$this->excel1->getActiveSheet()->setCellValue('F3', 'No Sertifikat');
                $this->excel1->getActiveSheet()->getStyle('F3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
				$this->excel1->getActiveSheet()->setCellValue('G3', 'Keterangan');
                $this->excel1->getActiveSheet()->getStyle('G3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
				$this->excel1->getActiveSheet()->setCellValue('H3', 'File Audit');
                $this->excel1->getActiveSheet()->getStyle('H3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
	
	

                $tbaudit = $this->data['tbaudit1'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                foreach ($tbaudit as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
					$E = 'E' . $itungan;
					$F = 'F' . $itungan;
					$G = 'G' . $itungan;
					$H = 'H' . $itungan;
					
                    if ($row->status_audit == '1') {
                        $statusa = "Sudah";
                    } else {
                        $statusa = "Belum";
                    }
					if ($row->ruang_lingkup != '') {
						if ($row->ruang_lingkup == 'Seluruh'){
							$ruang_lingkup = 'Seluruh peralatan pemanfaat energi utama' ;
						}else {
							$ruang_lingkup = 'Sebagian peralatan pemanfaat energi utama' ;
						}
                        
                    } else {
                        $ruang_lingkup = " - ";
                    }
					if ($row->bulan_pelaksanaan != '' or $row->tahun_pelaksanaan != '') {
                        $bulan_tahun_pelaksanaan = $row->bulan_pelaksanaan.'-'.$row->tahun_pelaksanaan;
                    } else {
                        $bulan_tahun_pelaksanaan = " - ";
                    }
					if ($row->nama_auditor != '') {
                        $nama_auditor = $row->nama_auditor;
                    } else {
                        $nama_auditor = " - ";
                    }
					if ($row->no_sertifikat != '') {
                        $no_sertifikat = $row->no_sertifikat;
                    } else {
                        $no_sertifikat = " - ";
                    }
                    if ($row->keterangan_audit != '') {
                        $ket = $row->keterangan_audit;
                    } else {
                        $ket = " - ";
                    }
                    if ($row->file_audit != '') {
                        $file = 'http://aplikasi.ebtke.esdm.go.id/pome/uploads/audit/'.$row->file_audit;
                    } else {
                        $file = " - ";
                    }
                    $this->excel1->getActiveSheet()->setCellValue($A, $row->jenis_peralatan);
                    $this->excel1->getActiveSheet()->setCellValue($B, $statusa);
					$this->excel1->getActiveSheet()->setCellValue($C, $ruang_lingkup);
					$this->excel1->getActiveSheet()->setCellValue($D, $bulan_tahun_pelaksanaan);
					$this->excel1->getActiveSheet()->setCellValue($E, $nama_auditor);
					$this->excel1->getActiveSheet()->setCellValue($F, $no_sertifikat);
                    $this->excel1->getActiveSheet()->setCellValue($G, $ket);
                    $this->excel1->getActiveSheet()->setCellValue($H, $file);
                    $itungan = $itungan + 1;
                }

                //Rekomendasi Hasil Audit Energi
                $this->excel1->createSheet();
                $this->excel1->setActiveSheetIndex(11);
                $this->excel1->getActiveSheet()->setTitle('Rekomendasi Audit Energi');
                $this->excel1->getActiveSheet()->setCellValue('A1', 'Rekomendasi Hasil Audit Energi');
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel1->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->mergeCells('A1:D1');
                $this->excel1->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel1->getActiveSheet()->setCellValue('A3', 'Jenis Peralatan');
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('B3', 'Rekomendasi');
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('C3', 'Potensi Penghematan (Gjoule)');
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('D3', 'Jenis Rekomendasi');
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
                $this->excel1->getActiveSheet()->setCellValue('E3', 'Rencana Implementasi Tahun ke-');
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
                $this->excel1->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

                $tbraudit = $this->data['tbraudit'];
                $itungan = 4;
                $A = 'A';
                $B = 'B';
                $C = 'C';
                $D = 'D';
                $E = 'E';
                foreach ($tbraudit as $row) {
                    $A = 'A' . $itungan;
                    $B = 'B' . $itungan;
                    $C = 'C' . $itungan;
                    $D = 'D' . $itungan;
                    $E = 'E' . $itungan;

                    $this->excel1->getActiveSheet()->setCellValue($A, $row->jenis_peralatan);
                    $this->excel1->getActiveSheet()->setCellValue($B, $row->rekomendasi);
                    $this->excel1->getActiveSheet()->setCellValue($C, $row->potensi_penghematan);
                    $this->excel1->getActiveSheet()->setCellValue($D, $row->jenis_peralatan);
                    $this->excel1->getActiveSheet()->setCellValue($E, $row->rencana_implementasi);

                    $itungan = $itungan + 1;
                }

                // save file
                $namaperusahaanxls = str_replace(" ", "_", $namaperusahaanP);
                $filename = 'lihat_laporan_' . $namaperusahaanxls . '_tahun_' . $tahuncari . '_' . date("YmdHis") . '.xls';

                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                $objWriter = PHPExcel_IOFactory::createWriter($this->excel1, 'Excel5');
                $objWriter->save('php://output');


            }


        } else {
            $this->load->view('no_access', $this->data);
        }

    }

    public function print2pdf1()
    {
        $IdPerusahaanP = $this->input->get('idp');
        $tahunP = $this->input->get('tahun');

        if ($IdPerusahaanP == "") {
            $idp = $this->session->userdata('id_perusahaan');
        } elseif ($this->session->userdata('privilege_id') == "2") {
            $idp = $IdPerusahaanP;
        } else {
            $this->load->view('no_access', $this->data);
        }
        if ($tahunP == "") {
            $tahuncari = (date("Y") - 1);
        } elseif ($this->session->userdata('privilege_id') == "2") {
            $tahuncari = $tahunP;
        } else {
            $this->load->view('no_access', $this->data);
        }

        $this->load->helpers('pdfLihatLaporan');
        $pdf = new PDF();

        $querydata = $this->lihatlaporan_model->cekdataOrg($this->data, $idp, $tahuncari);
        $querydata1 = $this->lihatlaporan_model->cekdata($this->data, $idp, $tahuncari);

        if ($querydata['OrgMgmntEnergi'] == '1') {
            $organisasi = "Ada";

        } else {
            $organisasi = "Tidak Ada";
        }
        if ($querydata['MgrEnergi'] == '1') {
            $MgrEnergi = "Ada";
        } else {
            $MgrEnergi = "Tidak Ada";
        }

        $datainfo = array(
            array('Nama Perusahaan', ': ' . $querydata1['NamaPerusahaan']),
            array('Type Perusahaan', ': ' . $querydata1['TypePerusahaan']),
            array('NamaSubsektor', ': ' . $querydata1['NamaSubsektor']),
            array('Sub sektor Lain', ': ' . $querydata1['SubsektorLain']),
            array('Alamat Perusahaan', ': ' . $querydata1['AlamatPerusahaan']),
            array('    Kota/Kab', ': ' . $querydata1['KotaKab']),
            array('    Provinsi', ': ' . $querydata1['Prov']),
            array('No Telp', ': ' . $querydata1['NoTelp']),
            array('No Fax', ': ' . $querydata1['NoFax']),
            array('Thn Awal Operational', ': ' . $querydata1['ThnAwalOp']),
            array('Jumlah Karyawan', ': ' . $querydata1['JmlKaryawan'])
        );
        $dataorg = array(
            array('Ada/Tidak Organisasi Energi ', ': ' . $organisasi),
            array('    File Struktur Organisasi ', ': ' . $querydata['PathFileOrg']),
            array('Ada/Tidak Manager Energi ', ': ' . $MgrEnergi),
            array('pathfilesertifikat', ': ' . $querydata['PathFileSertifikat']),
            array('emailmanager', ': ' . $querydata['EmailMgrEnergi']),
            array('namamanager', ': ' . $querydata['NamaMgrEnergi']),
            array('notelepon', ': ' . $querydata['NoTlpMgrEnergi']),
            array('nosertifikat', ': ' . $querydata['NoSertMgrEnergi']),


        );


        $header = array('start', 'Name');
        //First page
        $pdf->AddPage();
        $pdf->SetLeftMargin(20);
        $pdf->SetReportFirstPageHead(base_url() . 'img/logo.png', 'Laporan Managemen Energi tahun ' . (date("Y") - 1), date('F j, Y'), '', $datainfo);
        $pdf->Tableinfo($header, $datainfo);
        $pdf->TableOrg($header, $dataorg);

        $pdf->Output();
    }

    //para list
    function listjenisproduksi()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }


        $this->datatables->select('c.NamaSubsektor,jenis_produksi, jumlah, satuan, id_jenis_produksi', false)
            ->from('t_jenis_produksi AS a')
            ->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
            ->join('tm_subsektor AS c', 'b.IdSubsektor=c.IdMSubsektor')
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('tahun = ' . $tahun);

        echo $this->datatables->generate();
    }

    function listluasbangunan()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('c.NamaSubsektor,nama_bangunan, luas_bangunan, id_luas_bangunan', false)
            ->from('t_luas_bangunan AS a')
            ->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
            ->join('tm_subsektor AS c', 'b.IdSubsektor=c.IdMSubsektor')
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('tahun = ' . $tahun);

        echo $this->datatables->generate();
    }

    function listpemakaianenergi()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('b.JenisEnergi as JenisEnergi, c.detail_jenis_energi as detail_jenis_energi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_pemakaian_energi as id_pemakaian_energi, b.Satuan AS Satuan,c.faktor_emisi', false)
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('a.tahun = ' . $tahun)
            ->from('t_pemakaian_energi AS a')
            ->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi', 'INNER')
            ->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail=c.id_jenis_energi_detail', 'INNER');
        echo $this->datatables->generate();
    }

    function listperalatanpemanfaatenergi()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, d.detail_jenis_energi as detail_jenis_energi,b.JenisEnergi as JenisEnergi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, b.Satuan AS Satuan, ((a.gjoule/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=' . $tahun . ' AND id_perusahaan=' . $id_perusahaan . ')) * 100) AS persentase', false)
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('a.tahun = ' . $tahun)
            ->from('t_peralatan_pemanfaat_energi AS a')
            ->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
            ->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan')
            ->join('tm_jenisenergidetail AS d', 'a.id_jenis_energi_detail=d.id_jenis_energi_detail');

        echo $this->datatables->generate();
    }

    function listkegiatankonservasi()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        //$this->datatables->select('kegiatan, faktor_emisi, realisasi_gjoule, realisasi_persen, realisasi_emisi, realisasi_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, a.konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi,b.jenis_peralatan_lain')
        $this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, realisasi_gjoule, realisasi_persen, realisasi_emisi, keterangan, faktor_emisi, realisasi_emisi_persen, JenisPeralatan, JenisEnergi, detail_jenis_energi, a.konversi, id_kegiatan_konservasi,b.jenis_peralatan_lain')
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('a.tahun = ' . $tahun)
            ->from('t_kegiatan_konservasi_new as a')
            ->join('t_peralatan_pemanfaat_energi AS b', 'a.id_peralatan_pemanfaat_energi = b.id_peralatan_pemanfaat_energi', 'INNER');

        echo $this->datatables->generate();
    }

    function listkegiatankonservasilain()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi_lain')
            ->where('id_perusahaan = ' . $id_perusahaan)
            ->where('tahun = ' . $tahun)
            ->from('t_kegiatan_konservasi_lain');

        echo $this->datatables->generate();
    }

    function listrencanakonservasi()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        //$this->datatables->select('kegiatan, faktor_emisi, target_gjoule, target_persen, target_emisi, target_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi')
        $this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, target_gjoule, target_persen, target_emisi, keterangan, target_emisi_persen, JenisPeralatan, JenisEnergi, detail_jenis_energi, konversi,  faktor_emisi,  id_rencana_konservasi')
            ->where('id_perusahaan = ' . $id_perusahaan)
            ->where('tahun = ' . $tahun)
            ->from('t_rencana_konservasi_new as a');

        echo $this->datatables->generate();
    }

    function listrencanakonservasilain()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi_lain')
            ->where('id_perusahaan = ' . $id_perusahaan)
            ->where('tahun = ' . $tahun)
            ->from('t_rencana_konservasi_lain');

        echo $this->datatables->generate();
    }

    function listaudit()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit, a.keterangan_audit, a.file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi', false)
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('a.tahun = ' . $tahun)
            ->from('t_peralatan_pemanfaat_energi AS a')
            ->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
        echo $this->datatables->generate();
    }
    function listraudit()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y") - 1;
        }

        $this->datatables->select('c.JenisPeralatan as jenis_peralatan, rekomendasi, potensi_penghematan, jenis_rekomendasi, rencana_implementasi, a.id_peralatan_pemanfaat_energi, id_rekomendasi_audit',false)
            ->where('a.id_perusahaan = '.$id_perusahaan)
            ->where('a.tahun = '.$tahun)
            ->from('t_rekomendasi_audit as a')
            ->join('t_peralatan_pemanfaat_energi AS p', 'a.id_peralatan_pemanfaat_energi=p.id_peralatan_pemanfaat_energi')
            ->join('tm_jenisperalatan AS c', 'p.id_jenis_peralatan=c.IdJenisPeralatan');

        echo $this->datatables->generate();
    }

    function listkonsumsienergispesifik()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y");
        }
        $this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
            ->where('id_perusahaan = ' . $id_perusahaan)
            ->from('vkons_energi_spesifik');
        echo $this->datatables->generate();
    }

    function listkonsumsienergispesifikbang()
    {
        $id_perusahaan = $this->input->get('idp', TRUE);
        $tahun = $this->input->get('tahunp', TRUE);
        if ($id_perusahaan == "") {
            $id_perusahaan = $this->session->userdata('id_perusahaan');
        }
        if ($tahun == "") {
            $tahun = date("Y");
        }
        $this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
            ->where('id_perusahaan = ' . $id_perusahaan)
            ->from('vkons_energi_spesifik_bang');
        echo $this->datatables->generate();
    }
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
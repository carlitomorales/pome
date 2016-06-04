<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Peralatanpemanfaat extends CI_Controller
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
        $this->load->model('jenisenergi_model');
        $this->load->model('jenisperalatan_model');
        $this->load->model('peralatanpemanfaatenergi_model');
        $this->load->model('lihatlaporan_model');
    }

    public function index()
    {
        //Dropdown master
        $idp = $this->session->userdata('id_perusahaan');
        $tahun = date("Y") - 1;
        $this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdowndetail($idp);
        $this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        $typeperusahaan = $this->session->userdata('type_perusahaan');
        $this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
        $this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
        $this->data['detailjenisperalatan'] = $this->peralatanpemanfaatenergi_model->getByIdpAndTahun($idp,$tahun);
        $querydata = $this->peralatanpemanfaatenergi_model->cekpersen($this->data, $idp, $tahun);
        //$this->data['persentase_energi'] = $querydata['persentase'];
        $this->session->set_userdata('persentase_energi', $querydata['persentase']);

        $this->load->view('inputperalatanpemanfaatenergi', $this->data);


    }

    function saveperalatanpemanfaatenergi()
    {
        $status = "";
        $msg = "";

        $idp = $this->session->userdata('id_perusahaan');
        $tahun = date("Y") - 1;
        $querydata = $this->peralatanpemanfaatenergi_model->cekpersen($this->data, $idp, $tahun);
        //$this->data['persentase_energi'] = $querydata['persentase'];
        $this->session->set_userdata('persentase_energi', $querydata['persentase']);


        $id_peralatan_pemanfaat_energi = $this->input->post('id_peralatan_pemanfaat_energi');
        $id_jenis_peralatan = $this->input->post('id_jenis_peralatan');
        $jenis_peralatan_lain = $this->input->post('jenis_peralatan_lain');
        $detail_jenis_peralatan = $this->input->post('detail_jenis_peralatan');
        $id_jenis_energi_detail = $this->input->post('id_jenis_energi');
        $jenis_energi_lain = $this->input->post('jenis_energi_lain');
        $original_unit = $this->input->post('original_unit');
        $konversi = $this->input->post('konversi');
        $gjoule = $this->input->post('gjoule');
        $data_jenisenergi = $this->jenisenergi_model->get_jenisenergi($id_jenis_energi_detail);
        foreach ($data_jenisenergi as $row) {
            $id_jenis_energi = $row->IdJenisEnergi;
        }


        $this->db->trans_start();
        if ($id_peralatan_pemanfaat_energi != '') {
            $data = array(
                'id_jenis_peralatan' => $id_jenis_peralatan,
                'jenis_peralatan_lain' => $jenis_peralatan_lain,
                'id_jenis_energi' => $id_jenis_energi,
                'id_jenis_energi_detail' => $id_jenis_energi_detail,
                'jenis_energi_lain' => $jenis_energi_lain,
                'original_unit' => $original_unit,
                'konversi' => $konversi,
                'gjoule' => $gjoule,
                'update_by' => $this->session->userdata('username'),
                'update_date' => date("Y-m-d H:i:s")
            );
            $this->peralatanpemanfaatenergi_model->edit($id_peralatan_pemanfaat_energi, $data);
        } else {
            $data = array(
                'id_jenis_peralatan' => $id_jenis_peralatan,
                'jenis_peralatan_lain' => $jenis_peralatan_lain,
                'detail_jenis_peralatan' => $detail_jenis_peralatan,
                'id_jenis_energi' => $id_jenis_energi,
                'id_jenis_energi_detail' => $id_jenis_energi_detail,
                'jenis_energi_lain' => $jenis_energi_lain,
                'original_unit' => $original_unit,
                'konversi' => $konversi,
                'gjoule' => $gjoule,
                'tahun' => date("Y") - 1,
                'id_perusahaan' => $this->session->userdata('id_perusahaan'),
                'create_by' => $this->session->userdata('username'),
                'create_date' => date("Y-m-d H:i:s")
            );
            $newid = $this->peralatanpemanfaatenergi_model->insert($data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $status = "error";
            $msg = "Terjadi kesalahan saat menyimpan data peralatan pemanfaat energi utama, silakan coba lagi.";
        } else {
            $totalpersen = $this->input->post('IdTotalPersen');
            $floatTotalPersen = floatval($totalpersen);
            if ($floatTotalPersen > 60) {
                $this->stepsubmit();
            }

            $status = "success";
            $msg = "Penyimpanan data peralatan pemanfaat energi utama berhasil.";
        }


        echo json_encode(array("status" => $status, "msg" => $msg));
    }

    public function stepsubmit()
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
                'submit_step5' => '1'
            );
            $this->lihatlaporan_model->edit($id, $data);
        } else {
            $data = array(
                'IdPerusahaan' => $id,
                'submit_step5' => '1',
                'tahun' => date("Y") - 1
            );
            $this->lihatlaporan_model->insert($data);
        }


    }

    function hapus($id)
    {
        $this->db->trans_start();
        $this->peralatanpemanfaatenergi_model->del($id);
        $this->db->trans_complete();
    }

    function listperalatanpemanfaatenergi()
    {
        $id_perusahaan = $this->session->userdata('id_perusahaan');
        $tahun = date("Y") - 1;
        $this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, d.detail_jenis_energi as detail_jenis_energi,b.JenisEnergi as JenisEnergi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, b.Satuan AS Satuan, ((a.gjoule/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=' . $tahun . ' AND id_perusahaan=' . $id_perusahaan . ')) * 100) AS persentase', false)
            ->where('a.id_perusahaan = ' . $id_perusahaan)
            ->where('a.tahun = ' . $tahun)
            ->from('t_peralatan_pemanfaat_energi AS a')
            ->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
            ->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan')
            ->join('tm_jenisenergidetail AS d', 'a.id_jenis_energi_detail=d.id_jenis_energi_detail');


        echo $this->datatables->generate();
    }

    function getDetail($id)
    {
        $rowdata = $this->peralatanpemanfaatenergi_model->getById($id);
        echo json_encode($rowdata);
    }

    function getSatuanJenisEnergi($id)
    {
        $data_jenisenergi = $this->jenisenergi_model->get_jenisenergi($id);
        foreach ($data_jenisenergi as $row) {
            $id_jenis_energi = $row->IdJenisEnergi;
        }
        $rowdata = $this->jenisenergi_model->getSatuan($id_jenis_energi);
        echo json_encode($rowdata);
    }

    function getKonversi($id)
    {
        $idp = $this->session->userdata('id_perusahaan');
        $rowdata = $this->jenisenergi_model->getKonversiDetail($id, $idp);
        echo json_encode($rowdata);
    }

    function getOriginalUnitPeralatan($id)
    {
        $idp = $this->session->userdata('id_perusahaan');
        $rowdata = $this->peralatanpemanfaatenergi_model->getOriginalUnitPeralatanDetail($id, $idp);
        echo json_encode($rowdata);
    }

    function getOriginalUnitPeralatanEdit()
    {
        $id = $this->input->get('energi');
        $idp = $this->session->userdata('id_perusahaan');
        $idalat = $this->input->get('alat');
        $rowdata1 = $this->peralatanpemanfaatenergi_model->getOriginalUnitPeralatanDetailIfEdit($id, $idp, $idalat);
        echo json_encode($rowdata1);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
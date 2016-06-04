<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inputberita extends CI_Controller {

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
		$this->load->model('berita_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->load->view('inputberita', $this->data);
	}

    public function image_list()
    {
        $map = $this->dirtoarray('uploads/news', null, 'absolute');
        echo json_encode($map);
    }
    public function image_upload()
    {
        $url = base_url().'/uploads/news/';

        move_uploaded_file($_FILES["imageName"]["tmp_name"],"uploads/news/" . $_FILES["imageName"]["name"]);

// return the complete path (absolute/relative) of uploaded image in response
        echo "<div id=\"image\">".$url. $_FILES["imageName"]["name"] . "</div>";


    }
    public function dirtoarray($dir, $separator = DIRECTORY_SEPARATOR, $paths = 'relative')
    {
        $result = array();
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . $separator . $value)) {
                    $result[$value] = $this->dirtoarray($dir . $separator . $value, $separator, $paths);
                } else {
                    if ($paths == 'relative') {
                        $result[] = $dir . '/' . $value;
                    } elseif ($paths == 'absolute') {
                        $result[] = base_url() . $dir . '/' . $value;
                    }
                }
            }
        }
        return $result;
    }

	function save(){	
		$status = '';
		$msg = '';	
		/*
		if(empty($_POST['id_peralatan_pemanfaat_energi'])){
			$status = 'error';
			$msg = 'Silakan pilih peralatan pemanfaat energi utama yang akan dilaporkan hasil auditnya.';
		}
		if(empty($_POST['status_audit'])){
			$status = 'error';
			$msg = 'Silakan pilih status audit.';
		}
		if(empty($_POST['keterangan_audit'])){
			$status = 'error';
			$msg = 'Silakan isi keterangan hasil audit.';
		}
		*/
		if($status != 'error'){
			$news_id = $_POST['news_id'];
			$title = $_POST['title'];
			$publish_date = $_POST['publish_date'];
			$sinopsis = $_POST['sinopsis'];
			$detail = $_POST['detail'];
			$file_element_name = 'thumbnail';
			if($_FILES['thumbnail']['tmp_name'] != ''){
				$config['upload_path'] = './uploads/news/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
				$config['max_size'] = 512;
				$config['encrypt_name'] = TRUE;
				
				$this->load->library('upload', $config);
	 
				if (!$this->upload->do_upload($file_element_name))
				{
					$status = 'error';
					$msg = $this->upload->display_errors('', '');
				}
				else
				{
					$datafile = $this->upload->data();
					$this->db->trans_start();
					if($news_id == ''){
						$data = array(
							'title' => $title,
							'publish_date' => $publish_date,
							'sinopsis' => $sinopsis,
							'detail' => $detail,
							'thumbnail' => $datafile['file_name'],
							'create_by' => $this->session->userdata('username'),
							'create_date' => date("Y-m-d H:i:s")
						);
						$news_id = $this->berita_model->insert($data);
					}else{						
						$data = array(
							'title' => $title,
							'publish_date' => $publish_date,
							'sinopsis' => $sinopsis,
							'detail' => $detail,
							'thumbnail' => $datafile['file_name'],
							'update_by' => $this->session->userdata('username'),
							'update_date' => date("Y-m-d H:i:s")
						);
						$this->berita_model->edit($news_id,$data);
					}
					$this->db->trans_complete();
					if($this->db->trans_status() === FALSE)
					{
						unlink($datafile['full_path']);
						$status = "error";
						$msg = "Berita gagal disimpan, silakan coba lagi.";
					}
					else
					{
						$status = "success";
						$msg = "Berita berhasil disimpan.";
					}
				}
				@unlink($_FILES[$file_element_name]);
			}else{
				$this->db->trans_start();
				if($news_id == ''){
					$data = array(
						'title' => $title,
						'publish_date' => $publish_date,
						'sinopsis' => $sinopsis,
						'detail' => $detail,
						'create_by' => $this->session->userdata('username'),
						'create_date' => date("Y-m-d H:i:s")
					);
					$news_id = $this->berita_model->insert($data);
				}else{						
					$data = array(
						'title' => $title,
						'publish_date' => $publish_date,
						'sinopsis' => $sinopsis,
						'detail' => $detail,
						'update_by' => $this->session->userdata('username'),
						'update_date' => date("Y-m-d H:i:s")
					);
					$this->berita_model->edit($news_id,$data);
				}
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$status = "error";
					$msg = "Berita gagal disimpan, silakan coba lagi.";
				}else{
					$status = "success";
					$msg = "Berita berhasil disimpan.";
				}
			}			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function get_list(){
		$this->datatables->select('title, publish_date, create_date, create_by, update_date, update_by, news_id', false)
			->from('t_news');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->berita_model->getById($id);
		echo json_encode($rowdata);
	}
	
	function hapus($id){
		$status = '';
		$msg = '';
		$this->db->trans_start();
		$this->berita_model->del($id);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE)
		{
			$status = "error";
			$msg = "Berita gagal dihapus, silakan coba lagi.";
		}else{
			$status = "success";
			$msg = "Berita berhasil dihapus.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
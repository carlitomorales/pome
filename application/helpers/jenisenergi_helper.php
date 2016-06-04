<?php	
	function get_user_action($id)
	{
		$ci = & get_instance();
		$action = '<a href="'.base_url().'jenisenergi/edit/'.$id.'"><button class="btn btn-mini btn-primary">Edit</button></a>&nbsp;';
		$action = '<a href="'.base_url().'jenisenergi/hapus/'.$id.'"><button class="btn btn-mini btn-primary">Delete</button></a>&nbsp;';

		return $action;
	}
	
	function get_user_active($id)
	{
		$html = '';
		switch($id)
		{
			case 0:
				$html = '<span class="label label-important">No</span>';
			break;
			case 1:
				$html = '<span class="label label-success">Yes</span>';
			break;
		}
		return $html;
	}
	
	function get_privilege_action($id)
	{
		$ci = & get_instance();
		$action = '<a href="'.base_url().'privilege/view/'.$id.'"><button class="btn btn-mini btn-primary">View</button></a>&nbsp;';
		$action .= '<a href="'.base_url().'privilege/edit/'.$id.'"><button class="btn btn-mini btn-primary">Edit</button></a>&nbsp;';
		//$action .= '<a href="#" onclick="confirmdel('."'".$id."'".')"><button class="btn btn-mini btn-warning">Delete</button></a>';
		return $action;
	}
?>
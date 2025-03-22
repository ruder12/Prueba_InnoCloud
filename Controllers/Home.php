<?php 

	class Home {
	
		public function home()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Home";
			$data['page_title'] = "Página principal";
			$data['page_name'] = "home";
			$data['page_content'] = "";
	
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}

	}
 ?>
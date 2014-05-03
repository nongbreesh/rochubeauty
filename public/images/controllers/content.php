<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

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
	function __construct()
	{
		parent::__construct();
	
		// SET META Tag
			$this->title		= 'ตัวแทนจำหน่ายน้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่มีส่วนผสมของน้ำมันมะพร้าวสกัดเย็น อาทิเช่น โลชั่นกันแดด , ครีมหมักผม , สครีบ , โลชั่นทาผิว , เซรั่ม , มากส์หน้า และอื่นๆ';
		$this->mTitle		=  'ตัวแทนจำหน่ายน้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่มีส่วนผสมของน้ำมันมะพร้าวสกัดเย็น อาทิเช่น โลชั่นกันแดด , ครีมหมักผม , สครีบ , โลชั่นทาผิว , เซรั่ม , มากส์หน้า และอื่นๆ';
		$this->mDesc		= 'เราเป็นตัวแทนจำหน่าย น้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่กำลังเป็นที่นิยมมากในขณะนี้';
		$this->mKeyword		= 'น้ำมันมะพร้าวสกัดเย็นบริสัทธิ์,น้ำมันมะพร้าว,ครีมมะพร้าว,Coconut Oil,ผลิตภัณท์ความงาม';
		$this->load->helpers('url_helper');
		$this->load->model('get_data','_data');
	}
	
	
	public function index()
	{
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		
		
		
		$this->load->view('template/head',$data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('template/body');
		$this->load->view('template/footer');
	}
	public function view($id)
	{
		$data['Categories_list'] = $this->_data->getCategories();

	
		
		$data['currentMenu']		= "";
		$data['content_detail'] = $this->_data->getContents_detail($id);
		
		$data['title']		= 	$data['content_detail']->title . " | BitmeR";
		$data['mTitle']		= $data['content_detail']->title . " | BitmeR";
		$data['mDesc']		= $data['content_detail']->shortdesc . " | BitmeR";
		$data['mKeyword']	= 	$data['content_detail']->title;
		
		
		$this->load->view('template/head',$data);
		$this->load->view('content/sidebar');
		$this->load->view('content/body',$data);
		$this->load->view('template/rightbar');
		$this->load->view('template/footer');
	}
	
	public function viewfeed($id)
	{
		$data['content_detail'] = $this->_data->getContents_detail($id);

		$data['title']		= 	$data['content_detail']->title . " | BitmeR";
		$data['mTitle']		= $data['content_detail']->title . " | BitmeR";
		$data['mDesc']		= $data['content_detail']->shortdesc . " | BitmeR";
		$data['mKeyword']	= 	$data['content_detail']->title;
		

		$this->load->view('content/body-feed',$data);

	}
	
	
	public function c($menu)
	{
		$data['Categories_list'] = $this->_data->getCategories();
		
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['currentMenu']		= $menu;
		$data['currentPage'] = $this->_data->getCategories_detail($menu);
		$data['Contents_list'] = $this->_data->getContents($data['currentPage']->id );
		
		$this->load->view('template/head',$data);
		$this->load->view('categories/sidebar');
		$this->load->view('categories/body',$data);
		$this->load->view('template/rightbar');
		$this->load->view('template/footer');
	}
	public function feedload()
	{
		$per_page=6;
		
		if(isset($_POST['pageLimit']) && !empty($_POST['pageLimit'])){
			 $pageLimit=$_POST['pageLimit'];
		}else{
			 $pageLimit=0;
		}
		$pageLimit=$pageLimit;
		$data['loadCount'] = $pageLimit+$per_page;
		$data['per_page'] = $pageLimit+$per_page;
		$data['Content_feed'] = $this->_data->getContents_feed($per_page,$pageLimit);
	
		$this->load->view('template/feed' , $data);

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
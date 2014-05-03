<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

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
	
			$this->load->helpers('url_helper');
			$this->load->model('get_feed','_feed');
			$this->load->helper('xml');
	}
	
	
	public function index($cate_id = null)
	{
		$data['Cate_id'] = $cate_id ;
		$data['Categories_list'] = $this->_feed->getCategories();
		$data['Content_list'] = $this->_feed->getContents_feed($cate_id);
		
		$this->load->view('feeds/news',$data);
	}
	public function detail($id = null)
	{
		$data['Content_detail'] = $this->_feed->getContents_detail($id);
		$this->load->view('feeds/detail',$data);
	}
	
	public function rss()
	{
		$this->load->helper('date');
		$data['encoding'] = 'UTF-8';
		$data['feed_name'] = 'BITIMER : IT NEWS';
		$data['feed_url'] = 'http://www.bitimer.com';
		$data['page_description'] = 'ข่าวไอที ทิป เทคนิค คอมพิวเตอร์ มือถือ สมาร์ทโฟน แท็บเล็ต โน้ตบุ๊ค อินเทอร์เน็ต นิตยสารคอมพิวเตอร์ commart คลิป|Bitimer';
		$data['page_language'] = 'en-th';
		$data['creator_email'] = 'breesh.comsci@gmail.com';
		$data['Content'] = $this->_feed->getContents();
		header("Content-type:application/rss+xml; charset=UTF-8");   
		$this->load->view('feeds/rss', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
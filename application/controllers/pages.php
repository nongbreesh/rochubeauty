<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		$this->load->model('get_cost','_cost');
		$this->load->model('Email','_email');
	}
	
	
	public function view($id)
	{
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductHit_list'] = $this->_data->getProductHit(8);
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Content'] = $this->_data->getContent($id);
		$data['Sidebar'] = $this->_data->getSidebar();
		$this->load->view('template/head',$data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('pages/body');
		$this->load->view('template/footer');
	}

          public function payment()
	{
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductHit_list'] = $this->_data->getProductHit(8);
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$this->load->view('template/head',$data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('pages/paymentform');
		$this->load->view('template/footer');
	}


	public function payment_process()
	{
	
		if($_POST)
		{

			$input['order_id']		=  $this->input->post('order_id');
			$input['bank_account']	= $this->input->post('bank_account');
			$input['date_pay']	= $this->input->post('date_pay');
			$input['time_pay']	= $this->input->post('time_pay');
			$input['amount']	= $this->input->post('amount');
			$input['full_name']	= $this->input->post('full_name');
			$input['tel']	= $this->input->post('tel');
			$input['email']	= $this->input->post('email');
			$input['message']	= $this->input->post('message');
			
			$this->insert_model->insert_Payment($input);
			
			
			
			
			$message_cust ="";
			$message_cust.= "MIME-Version: 1.0\n"
			. "Content-Type:text/html; charset=windows-874\n";
			$message_cust = "<html>
<body>";
			$message_cust .= ' <b>ORDER ID : #'.$this->input->post('order_id').'</b></BR>
<table width="100%" class="display_basket" cellpadding="0" cellspacing="0">
<tr >
<td style="padding:2px; background:#666;">เลขที่ใบสั่งซื้อ</td>
<td style="padding:2px; background:#666;">ชำระเงินเข้าบัญชี</td>
<td style="padding:2px; background:#666;">วันที่ชำระเงิน</td>
<td style="padding:2px; background:#666;">เวลา.</td>
<td style="padding:2px; background:#666;">จำนวนเงิน</td>
<td style="padding:2px; background:#666;">ชื่อ</td>
<td style="padding:2px; background:#666;">เบอร์โทรศัพท์</td>
<td style="padding:2px; background:#666;">อีเมลล์</td>
</tr> ';
			$message_cust .= "<tr>
<td>".$this->input->post('order_id')."</td>
<td>".$this->input->post('bank_account')."</td>
<td>".$this->input->post('date_pay')."</td>
<td>".$this->input->post('time_pay')."</td>
<td>".$this->input->post('amount')."</td>
<td>".$this->input->post('full_name')."</td>
<td>".$this->input->post('tel')."</td>
<td>". $this->input->post('message')."</td>
</tr></table>";
		
			
			
			$this->_email->sendpaymentinfo($message_cust,'subble_comsci@hotmail.com','#'.$this->input->post('order_id').' Payment Detial  ขายน้ำมันมะพร้าว.com');

	
			$this->load->view('pages/paymentprocess');
				
		}
		//$this->load->view('cart/cardProcessing');
	}
	
	

	public function trackingdata()
	{
	
		if($_POST)
		{
			$data['gettrackingdata'] = $this->_data->gettrackingdata($this->input->post('txtorderid'));
		}
		
		
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductHit_list'] = $this->_data->getProductHit(8);
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$this->load->view('template/head',$data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('pages/trackingdata');
		$this->load->view('template/footer');
		
		
		
	}
	public function emailtest()
	{
		$this->_email->sendinfo('msg','subble_comsci@hotmail.com','#xxxxxxxxxxx');
		$this->_email->sendinfo('msg','breesh.comsci@gmail.com','#xxxxxxxxxxx');
	}
	
	public function contactus()
	{
	

		if($_POST)
		{
	
			$input['fullname']		=  $this->input->post('fullname');
			$input['tel']	= $this->input->post('tel');
			$input['message']	= $this->input->post('message');
			$input['email']	= $this->input->post('email');

				
			$this->insert_model->insert_Contactus($input);
			
			$this->_email->sendinfo($input['fullname'].' | '.$input['tel'].' | '.$input['message'].' | '.$input['email'],'subble_comsci@hotmail.com','คุณมีข้อความติดต่อจาก ขายน้ำมันมะพร้าว.com');
			
			
			echo "<script>alert('ส่งข้อมูลเรียบร้อย ทางร้านจะรีบติดต่อกลับโดยเร็วที่สุดค่ะ ขอบคุณที่สนใจผลิตภันท์ของเรา');</script>";
		}
		
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductHit_list'] = $this->_data->getProductHit(8);
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Content'] = $this->_data->getContent(14);
		$data['Sidebar'] = $this->_data->getSidebar();
		$this->load->view('template/head',$data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('pages/contactus');
		$this->load->view('template/footer');
		
		
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
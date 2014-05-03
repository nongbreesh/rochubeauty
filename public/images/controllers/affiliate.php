<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Affiliate extends CI_Controller {

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
		$this->load->model('email','_email');
		

	}
	
	
	public function index()
	{
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['aff_index'] = $this->_data->getAff_index();
		
		if($this->session->userdata('isMember') != true)
		{
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
		}
		else{
			$data['summaryAff']		= $this->summaryAff();
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/member_page');
			$this->load->view('template/footer');
			
		}
		
		
	}
	public function register()
	{
		
		if($_POST)
		{
			$input['username']= $this->input->post('username');
			$input['password']= $this->input->post('password');
			$input['fullname']= $this->input->post('fullname');
			$input['email']= $this->input->post('email');
			$input['birthday']= $this->input->post('birthday');
			$input['address']= $this->input->post('address');
			$input['province']= $this->input->post('province');
			$input['zipcode']= $this->input->post('zipcode');
			$input['tel']= $this->input->post('tel');
			$input['sex']= $this->input->post('sex');
			$input['website']= $this->input->post('website');
			$input['bankname']= $this->input->post('bank');
			$input['bankbranch']= $this->input->post('bankbranch');
			$input['bankno']= $this->input->post('bankno');
			$input['bankowner']= $this->input->post('bankowner');
			$input['banktype']= $this->input->post('banktype');
			$input['captcha']	= $this->input->post('captcha');
			
					// First, delete old captchas
					$expiration = time()-7200; // Two hour limit
					$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration); // Then see 
					$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = '".$input['captcha']."' AND ip_address = '".$this->input->ip_address()."' AND captcha_time > '".$expiration."'";
					$binds = array($input['captcha'], $this->input->ip_address(), $expiration);
					$query = $this->db->query($sql, $binds);
					$row = $query->row();
					if ($row->count == 0)  //ถ้าหากผลการค้นหามีค่ามากกว่า 0 แสดงว่าผู้ใช้พิมพ์อักษรถูกต้องครับ
					{
						echo "<script>history.back();alert('Captcha ผิด!! กรุณาลองอีกครั้ง');document.form1.captcha.focus();</script>";
					}
					else{
						$this->db->query("DELETE FROM captcha WHERE ip_address = '".$this->input->ip_address()."'"); // Then see
						
						if($this->check_model->check_memberRegister($input['email']))
						{
							$verify_code		= $this->insert_model->insert_User($input);
						}
						
						if(isset($verify_code) && $verify_code != '')
						{
							echo "<script>alert('สมัครสมาชิกเรียบร้อย!!กรุณายืนยันตนในอีเมลล์ของท่าน');</script>";
						
							// Send verify code via Email to Confirm User
							$this->_email->sendMailVerifyMember($this->input->post('email') ,$this->input->post('fullname') ,$verify_code);
							redirect(base_url().'affiliate/login');
						}
						else
						{

							echo "<script>history.back();alert('สมัครสมาชิกไม่สำเร็จ!!โปรดตรวจสอบอีเมลล์ของท่านว่าเคยใช้แล้วหรือยัง');</script>";
						}
						
						
						
					}
					
		}
		
		
		
		
		
		
		
		$this->load->helper('captcha');
		$vals = array(
				'img_path'   => './captcha/',
				'img_url'    => base_url().'captcha/'
		);
		$cap = create_captcha($vals);
		$data = array(
				'captcha_time'  => $cap['time'],
				'ip_address'    => $this->input->ip_address(),
				'word'   => $cap['word']
		);
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		

		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Province'] = $this->_data->getProvince();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		//$data['summaryAff']		= $this->summaryAff();
		$data['cap'] =  $cap['image'];
		$this->load->view('template/head' , $data);
		$this->load->view('template/slide');
		$this->load->view('template/sidebar');
		$this->load->view('affiliate/register');
		$this->load->view('template/footer');
	
	}
	public function logout()
	{
		$this->db->delete('session_db' ,array('your_session_id'=>$this->session->userdata('session_id')));
		
		$this->session->set_userdata(array('isMember'=>false));
		
		redirect(base_url().'affiliate');
	}
	public function login()
	{
	
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		
		if($_POST)
		{
			$this->load->model('login_model');
		
			
			$input['username']		= $this->input->post('username');
			$input['password']	= $this->input->post('password');
				
			if($this->login_model->login_user($input))
			{
				$this->session->set_userdata(array('isMember'=>true,'username'=>$input['username']));
				redirect(base_url().'affiliate');
			}
			else
			{
				$data['post_check']	= false;
			}
			
			
			
				
		}
		$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
	
	
	}
	
	public function profile()
	{
		
	
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Province'] = $this->_data->getProvince();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['summaryAff']		= $this->summaryAff();
		$username = $this->_data->getUserfromsession($this->session->userdata['session_id']);
		
		$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		

		$this->load->view('template/head' , $data);
		$this->load->view('template/slide');
		$this->load->view('affiliate/sidebar');
		$this->load->view('affiliate/profile');
		$this->load->view('template/footer');
	}
	
	public function membereditpass()
	{
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['summaryAff']		= $this->summaryAff();
		$data['Province'] = $this->_data->getProvince();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		
		
		if($_POST)
		{
		
			$input['password']= $this->input->post('password');
				
				
				
			$this->load->model('update_data');
				
			if($this->update_data->update_membereditprofilePW($this->session->userdata['username'],$input))
			{
				$data['post_UpdatememberPW']	= true;
					
			}
			else
			{
				$data['post_UpdatememberPW']	= false;
			}
				
				
		
				
			$username = $this->_data->getUserfromsession($this->session->userdata['session_id']);
				
			$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		
				
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/profile');
			$this->load->view('template/footer');
		
		}
	}
	public function membereditprofile()
	{
	
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['summaryAff']		= $this->summaryAff();
		$data['Province'] = $this->_data->getProvince();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		
		
		if($_POST)
		{
		
			$input['fullname']= $this->input->post('fullname');
			$input['email']= $this->input->post('email');
			$input['birthday']= $this->input->post('birthday');
			$input['address']= $this->input->post('address');
			$input['province']= $this->input->post('province');
			$input['zipcode']= $this->input->post('zipcode');
			$input['tel']= $this->input->post('tel');
			$input['sex']= $this->input->post('sex');
			$input['website']= $this->input->post('website');
			$input['bankname']= $this->input->post('bank');
			$input['bankbranch']= $this->input->post('bankbranch');
			$input['bankno']= $this->input->post('bankno');
			$input['bankowner']= $this->input->post('bankowner');
			$input['banktype']= $this->input->post('banktype');
			
			
			
			
			$this->load->model('update_data');
			
			if($this->update_data->update_membereditprofile($this->session->userdata['username'],$input))
			{
				$data['post_Updatemember']	= true;
			
			}
			else
			{
				$data['post_Updatemember']	= false;
			}
			
			
		
			
			$username = $this->_data->getUserfromsession($this->session->userdata['session_id']);
			
			$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
	
			
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/profile');
			$this->load->view('template/footer');

		}
	}
	
	
	function verify($code)
	{
	$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		
		
		if($code == ''): redirect(base_url()); endif;
	
		$this->load->model('check_model');
	
		if($this->check_model->check_memberVerify($code))
		{
			$data['post_Verify']	= true;
	
		}
		else
		{
			$data['post_Verify']	= false;
		}
	
		// #################
		// GLOBAL SETTING
		$data['title']			= $this->title;
		$data['mTitle']			= $this->mTitle;
		$data['mDesc']			= $this->mDesc;
		$data['mKeyword']		= $this->mKeyword;


			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
	
	
	}
	
	public function banner()
	{
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		$data['summaryAff']		= $this->summaryAff();
		if($this->session->userdata('isMember') != true)
		{
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
		}
		else{
				
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/banner');
			$this->load->view('template/footer');
				
		}
	
	
	}
	
	public function history()
	{
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		$data['summaryAff']		= $this->summaryAff();
		$data['PaymentRequest'] = $this->_data->getPaymentRequest($data['memberDetail']->verify_code);
		$data['Payment'] = $this->_data->getPaidDetail($data['memberDetail']->verify_code);
		
		$data['OrderList'] = $this->_data->getOrderList('',$data['memberDetail']->verify_code);
		

		if($this->session->userdata('isMember') != true)
		{
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
		}
		else{
	
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/history');
			$this->load->view('template/footer');
	
		}
	
	
	}
	
	public function withdraw(){
		
		
		if($_POST)
		{
			$memberDetail = $this->_data->getmemberDetail($this->session->userdata['username']);
			$input['amount']= $this->input->post('amount');
			$input['user'] = $this->session->userdata['username'];
			$input['acc'] = $memberDetail->verify_code;
			

			
			if($this->insert_model->insert_PaymentRequest($input))
			{
				$data['post_Success']	= true;
			
			}
			else
			{
				$data['post_Success']	= false;
			}
		}
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		$data['summaryAff']		= $this->summaryAff();
		
		
		if($this->session->userdata('isMember') != true)
		{
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
		}
		else{
		
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/withdraw');
			$this->load->view('template/footer');
		
		}
	}
	
	
	public function summaryAff(){
		$memberDetail = $this->_data->getmemberDetail($this->session->userdata['username']);
		$PaymentHistory = $this->_data->getPaymentRequest($memberDetail->verify_code);
		$OrderList = $this->_data->getOrderList('',$memberDetail->verify_code);
		$totalprice = 0;	
foreach($OrderList as $items){
			
$summary = $this->_data->getOrderDetail($items->order_id);
$sumprice = 0;
$sumpricemod = 0;
foreach($summary as $itemsum){
	if($items->is_payment == 1){
		$sumprice = $sumprice + $itemsum->priceaff * $itemsum->qty;
		$sumpricemod = ($sumprice * 15)  / 100;
	}

}
$totalprice = $totalprice + $sumpricemod;
		}

		
		return $totalprice - $PaymentHistory->sumpayment;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function traffic()
	{
		$this->load->helper('text');
		$data['title']		= $this->title;
		$data['mTitle']		= $this->mTitle;
		$data['mDesc']		= $this->mDesc;
		$data['mKeyword']	= $this->mKeyword;
		$data['ProductNew_list'] = $this->_data->getProductNew();
		$data['ProductOffer_list'] = $this->_data->getProductOffer();
		$data['Product_list'] = $this->_data->getProduct();
		$data['Cate_list'] = $this->_data->getCate();
		$data['Menutop'] = $this->_data->getMenutop();
		$data['Sidebar'] = $this->_data->getSidebar();
		$data['memberDetail'] = $this->_data->getmemberDetail($this->session->userdata['username']);
		$data['summaryAff']		= $this->summaryAff();
		$data['affclick']		= $this->_data->getAffclick($data['memberDetail']->verify_code);
		$data['affclickdaily']		= $this->_data->getAffclickdaily($data['memberDetail']->verify_code);
		
		if($this->session->userdata('isMember') != true)
		{
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('template/sidebar');
			$this->load->view('affiliate/body');
			$this->load->view('template/footer');
		}
		else{
				
			$this->load->view('template/head' , $data);
			$this->load->view('template/slide');
			$this->load->view('affiliate/sidebar');
			$this->load->view('affiliate/traffic');
			$this->load->view('template/footer');
				
		}
	
	
	}
	
	
	
	

	
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
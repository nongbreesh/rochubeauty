<?php
class Email extends CI_Model {
	
public function sendinfo($msg,$email,$subject)
{

	//config
	$config['protocol'] = 'smtp';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = FALSE;
	$config['mailtype'] = 'html';
	$config['smtp_host'] = 'mail.xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_user'] = 'noreply@xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_pass'] = 'p@ssw0rd';
	$this->email->initialize($config);
	//config
	$this->email->from('noreply@xn--22c0caunbdn0b1fiich05aia3d.com', 'www.ขายน้ำมันมะพร้าว.com');
	$this->email->to($email); //ส่งถึงใคร
	//$this->email->cc('subble_comsci@hotmail.com');
	$this->email->subject($subject); //หัวข้อของอีเมล
	$this->email->message($msg); //เนื้อหาของอีเมล
	$this->email->send();
	//echo $this->email->print_debugger();


}
public function sendpaymentinfo($msg,$email,$subject)
{

	//config
	$config['protocol'] = 'smtp';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = FALSE;
	$config['mailtype'] = 'html';
	$config['smtp_host'] = 'mail.xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_user'] = 'noreply@xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_pass'] = 'p@ssw0rd';
	$this->email->initialize($config);
	//config
	$this->email->from('noreply@xn--22c0caunbdn0b1fiich05aia3d.com', 'www.ขายน้ำมันมะพร้าว.com');
	$this->email->to($email); //ส่งถึงใคร
	$this->email->subject($subject); //หัวข้อของอีเมล
	$this->email->message($msg); //เนื้อหาของอีเมล
	$this->email->send();
	//echo $this->email->print_debugger();


}
public function sendMailVerifyMember($email ,$name ,$verify_code)
{
	$this->load->library('email');

	//config
	$config['protocol'] = 'smtp';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = FALSE;
	$config['mailtype'] = 'html';
	$config['smtp_host'] = 'mail.xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_user'] = 'noreply@xn--22c0caunbdn0b1fiich05aia3d.com';
	$config['smtp_pass'] = 'p@ssw0rd';
	$this->email->initialize($config);
	//config
	$this->email->from('noreply@xn--22c0caunbdn0b1fiich05aia3d.com', 'www.ขายน้ำมันมะพร้าว.com');
	$this->email->to($email);
	$this->email->subject('ยืนยันการสมัครสมาชิก  www.ขายน้ำมันมะพร้าว.com');

	$body	= '
					<div style="font-size:12px; font-family:tahoma;">
						<strong>Verify Member: </strong>
						---------------------------------------------------
						สวัสดีคุณ  '.$name.'
					
						<strong>กรุณายืนยันข้อมูลการสมัครสมาชิก โดยการคลิกลิงค์นี้ : </strong>
						<a href="http://www.xn--22c0caunbdn0b1fiich05aia3d.com/affiliate/verify/'.$verify_code.'" target="_blank">http://www.xn--22c0caunbdn0b1fiich05aia3d.com/affiliate/verify/'.$verify_code.'</a>
					
						Thankyou


					</div>
				';
	$this->email->message(nl2br($body));
	
	echo $this->email->print_debugger();
	$this->email->send();
}

}


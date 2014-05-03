<?php
/**
 * Model		: Insert_model
 *
 * Created by	: nuttanon
 * Date			: 2012-03-28
 *
 */
class Insert_model extends CI_Model 
{
	
	
	
	function insert_BannerClick($input)
	{
		$value	= array(
				'acc'		=>	$input['acc']	,
				'bannerid'		=>	$input['bannerid']	,
				'ip_address'		=>	$input['ip_address']
		);
	
		if($this->db->insert('aff_click' ,$value)):
		return true;
		else:
		return false;
		endif;
	}
	
	
	function insert_PaymentRequest($input)
	{
		$value	= array(
				'username'		=>	$input['user']	,
				'amount'		=>	$input['amount']	,
				'acc'		=>	$input['acc']
		);

		if($this->db->insert('withdraw_request' ,$value)):
		return true;
		else:
		return false;
		endif;
	}
	
	function insert_Contactus($input)
	{
		$value	= array(
				'full_name'		=>	$input['fullname']	,
				'tel'		=>	$input['tel']	,
				'message'		=>	$input['message'],
				'email'		=>	$input['email'],
		);
	
		$this->db->insert('contact_detail' ,$value);
	}
	function insert_Order($input)
	{
		$value	= array(
			'order_id'		=>	$input['order_id']	,
			'order_time'		=>	date('Y-m-d H:i:s'),
			'orders_address'		=>	$input['orders_address']	,
			'orders_ownername'		=>	$input['orders_ownername']	,
			'orders_providename'		=>	$input['orders_providename']	,
			'orders_zipcode'		=>	$input['orders_zipcode']	,
			'orders_tel'		=>	$input['orders_tel']	,
			'orders_email'		=>	$input['orders_email']	,
			'acc'		=>	$input['acc']
					);

		$this->db->insert('orders' ,$value);
	}
	function insert_Orderdetail($input)
	{
		$value	= array(
				'order_id'		=>	$input['order_id']	,
				'product_id'		=>	$input['product_id'],
				'qty'		=>	$input['qty']	,
				'price'		=>	$input['price']	
				
		);
	
		$this->db->insert('orderdetails' ,$value);
	}
function insert_Payment($input)
	{
		$value	= array(
				'order_id'		=>$input['order_id']		,
				'bank_account'		=>$input['bank_account']	,
				'date_pay'		=>$input['date_pay']	,
				'time_pay'		=>$input['time_pay']	,
				'amount'		=>$input['amount']	,
				'full_name'		=>$input['full_name']	,
				'tel'		=>$input['tel']	,
				'email'		=>$input['email']	,
				'message'		=>$input['message']	
		);
	
		$this->db->insert('payment_detail' ,$value);
	}
	function insert_User($input)
	{
		// Check member code
		$verify_code	= '';
		
		while($verify_code == '')
		{
			$verify_code_thumb	= substr(str_shuffle('ABCDEFGHIJKLMNPQRSTUVWXYZ123456789'),0,13);
			$this->db->select('verify_code');
			$this->db->where('verify_code' ,$verify_code_thumb);
			$query	= $this->db->get('user');
				
			if($query->num_rows() == '0')
			{
				$verify_code = $verify_code_thumb;
			}
		}
		
		$value	= array(
				'username'		=>$input['username']		,
				'password'		=>md5($input['password'])	,
				'fullname'		=>$input['fullname']	,
				'email'		=>$input['email']	,
				'birthday'		=>$input['birthday']	,
				'address'		=>$input['address']	,
				'province'		=>$input['province']	,
				'zipcode'		=>$input['zipcode']	,
				'tel'		=>$input['tel'],
				'sex'		=>$input['sex']	,
				'bankname'		=>$input['bankname']	,
				'bankbranch'		=>$input['bankbranch']	,
				'bankno'		=>$input['bankno']	,
				'bankowner'		=>$input['bankowner']	,
				'banktype'		=>$input['banktype']	,
				'user_type'		=> "1",
				'website'		=> $input['website']	,
				'verify_code'		=> $verify_code,
				'status'		=> "0"
		);
		
		if($this->db->insert('user' ,$value))
		{
			return $verify_code;
		}
		else
		{
			return false;
		}
		

	}
}
?>
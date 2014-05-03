<?php
class update_data extends CI_Model {
	
	function update_viewed($id ,$input)
	{

			$value	= array(
						'viewed'				=> $input['vcount']	
			);
		$this->db->where('id' ,$id);
		
		if($this->db->update('content' ,$value)):
			return true;
		else:
			return false;
		endif;
	}
	
	
	function update_membereditprofile($username ,$input)
	{
	
		$value	= array(
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
				'website'		=> $input['website']
		);
		$this->db->where('username' ,$username);
	
		if($this->db->update('user' ,$value)):
		return true;
		else:
		return false;
		endif;
	}
	
	
	function update_membereditprofilePW($username ,$input)
	{
	
		$value	= array(
				'password'		=> md5($input['password'])	
		);
		$this->db->where('username' ,$username);
	
		if($this->db->update('user' ,$value)):
		return true;
		else:
		return false;
		endif;
	}
}
?>
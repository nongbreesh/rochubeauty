<?php
/**
 * Model		: Login_model
 *
 * Created by	: nuttanon
 * Date			: 2012-03-28
 *
 */
class Login_model extends CI_Model {
	
	
	function login_user($input)
	{
		$input_value	= array(
				'username'		=> $input['username'] ,
				'password'	=> md5($input['password']) ,
				'status'	=> '1'
		);
	
		$this->db->select('*');
		$this->db->where($input_value);
	
		$query	= $this->db->get('user');
		if($query->num_rows == '1')
		{
			$this->db->delete('session_db' ,array('user'=>$input['username']));
			$input_value	= array(
					'your_session_id'	=> $this->session->userdata['session_id'] ,
					'user'				=> $input['username']
			);
	
			$this->db->insert('session_db' ,$input_value);
				
			return $query->row();
		}
		else
		{
			return false;
		}
	}

}
?>
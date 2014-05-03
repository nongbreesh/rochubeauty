<?php
/**
 * Model		: Check_model
 *
 * Created by	: nuttanon
 * Date			: 2012-03-28
 *
 */
class Check_model extends CI_Model {
	
	function check_memberRegister($email)
	{
		$this->db->select('email');
		$this->db->where('email' ,$email);
		$this->db->limit('1');

		$query	= $this->db->get('user')->num_rows();
		
		if($query == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function check_memberVerify($code)
	{
		// Check code 
		$this->db->select('verify_code');
		$this->db->where('verify_code' ,$code);
		$this->db->where('status' ,'0');
		$this->db->limit('1');

		$query	= $this->db->get('user')->num_rows();

		if($query == '1')
		{
			// Update status
			$this->db->where('verify_code' ,$code);
			if($this->db->update('user' ,array('status' => '1')))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

		

	function check_sessionId()
	{
		$this->db->select('*');
		$this->db->where('your_session_id' ,$this->session->userdata('session_id'));
		$query	= $this->db->get('session_db');

		if($query->num_rows() == '1')
		{
			$input_session = array('isMember' ,true);
			$this->session->set_userdata($input_session);

			return $query->row();
		}
		else
		{
			$input_session = array('isMember' ,'');
			$this->session->unset_userdata($input_session);

			return false;
		}
	}
}
?>
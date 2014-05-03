<?php
class get_feed extends CI_Model {
	
	function getCategories()
	{
		$this->db->select('*');
		$this->db->order_by('no','ASC');
		$query	= $this->db->get('categories');
	
		return $query->result();
	}
	

	
	function getContents_feed($cate_id = null)
	{
	
		$this->db->select('a.id aid,a.*,b.*');
		//$this->db->limit($per_page,$pageLimit);
		$this->db->order_by('a.timestamp','desc');
		if($cate_id != null){
			$this->db->where('a.categories_id',$cate_id);
		}
		$this->db->join('categories b','b.id = a.categories_id','INNER');
		$query	= $this->db->get('content a');
		return $query->result();
		
	}
	
	function getContents_detail($id = null)
	{
	
		$this->db->select('a.id aid,a.*,b.*');
		//$this->db->limit($per_page,$pageLimit);
		$this->db->order_by('a.timestamp','desc');
		$this->db->where('a.id',$id);
		$this->db->join('categories b','b.id = a.categories_id','INNER');
		$query	= $this->db->get('content a');
		return $query->result();
	
	}
	function getContents()
	{
	
		$this->db->select('a.id aid,a.*,b.*');
		//$this->db->limit(100,0);
		$this->db->order_by('a.timestamp','desc');
		$this->db->join('categories b','b.id = a.categories_id','INNER');
		$query	= $this->db->get('content a');
		return $query->result();
	
	}
	
}
?>
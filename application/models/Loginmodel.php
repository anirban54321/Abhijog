<?php
class Loginmodel extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function checklogin($username,$password)
	{  
	    $this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_group','users.u_ugid=user_group.ug_id');
		$this->db->where('u_username',$username);							
		$this->db->where('u_password',$password);							
		$this->query=$this->db->get();		
		//$noofrows = $this->query->num_rows();
		//return $noofrows;
		return $this->query->result();
	}

	public function get_user_data($username)
	{  
	    $this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_group','users.u_ugid=user_group.ug_id');
		$this->db->where('u_username',$username);									
		$this->query=$this->db->get();				
		return $this->query->result();
	}
	
}

?>
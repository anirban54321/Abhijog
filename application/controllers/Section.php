<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends Admin_Controller 
{
	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');	
		$this->load->model('Mailmodel');		
    }
	
    
}

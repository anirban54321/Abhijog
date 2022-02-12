<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_Error extends Admin_Controller {

	public function __construct() {
  
	  parent::__construct();
  
	  // load base_url
	  $this->load->helper('url');
	}
  
	public function index()
	{
	  $this->output->set_status_header('403'); 
	  $this->load->view('errors/page_error',$this->data);   
	}
}

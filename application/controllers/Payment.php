<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	
	function __construct()
    {
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->library('paypal');
        $this->load->model('crud_model');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }
	
	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		
	}
	
	
	/*
	*	$method		=	paypal/skrill/2CO/mastercard
	*/
	function pay_invoice()
	{
		if ($this->session->userdata('client_login') != 1)
        	redirect(base_url() . 'index.php?login', 'refresh');
		
		$method				=	$this->input->post('method');
		
	}
}


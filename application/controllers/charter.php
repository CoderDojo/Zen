<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Charter extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library(array('tank_auth','form_validation'));
		$this->load->model(array('charter_model'));
	}
	
	function index() {
	    if(!$this->tank_auth->is_logged_in()) {
	        $this->load->view('template/header');	        
	        $this->load->view('charter/textonly');
	        $this->load->view('template/footer');
	        return 0;
        }
	    $data['username'] = $this->tank_auth->get_username();
		$data['user_data'] =  $this->tank_auth->get_user_data();
		
	    if(Charter_Model::userHasSigned($this->tank_auth->get_user_data()->user_id)) {
	        $data['signed'] = new Charter_Model($this->tank_auth->get_user_data()->user_id);
	        $this->load->view('template/header', $data);	        
	        $this->load->view('charter/signed', $data);
	        $this->load->view('template/footer', $data);	        
        } else {
            redirect('/charter/sign');
        }
    }
    	
	function sign()
	{
	    $this->load->library(array('tank_auth'));
	    if(!$this->tank_auth->is_logged_in()) {
		    redirect('/auth/login');
		}
	    $data['username'] = $this->tank_auth->get_username();
		$data['user_data'] =  $this->tank_auth->get_user_data();
		
	    if(Charter_Model::userHasSigned($this->tank_auth->get_user_data()->user_id)) {
	        redirect('/charter');
	    } else {
	        $this->load->view('template/header', $data);
	        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean|max_length[255]');
	        $this->form_validation->set_rules('agree', 'I agree', 'required');
	        if($this->form_validation->run()) {
	            $nc = new Charter_Model;
	            $nc->full_name = $this->form_validation->set_value('name');
	            $nc->save();
	            redirect('/charter');
	        } else {
	            
            }
	        $this->load->view('charter/sign', $data);
	        $this->load->view('template/footer', $data);
	    }
    }
}
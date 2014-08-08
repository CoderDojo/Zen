<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
  public $view_data;
  
  public function __construct() {
    parent::__construct();
    $this->load->library('tank_auth');
    if($this->tank_auth->is_logged_in()){
			$this->view_data['username']  = $this->tank_auth->get_username();
			$this->view_data['user_data'] = $this->tank_auth->get_user_data();
			$this->view_data['is_admin']  = $this->view_data['user_data']->role == 0;
		} else {
			$this->view_data['username'] = NULL;
			$this->view_data['user_data'] = NULL;
			$this->view_data['is_admin']  = false;
		}
  }
  
  protected function load_view($page) {
    $this->load->view('template/header', $this->view_data);
		$this->load->view($page, $this->view_data);
		$this->load->view('template/footer');
  }
  
  protected function require_charter() {
    $this->load->model('charter_model');
	  if(!Charter_Model::userHasSigned($this->tank_auth->get_user_data()->user_id)) {
	    $this->session->set_userdata('c_redirect_from', '/dojo/create');
	    redirect('/charter/sign');
    }
  }
  
  protected function require_user() {
    if(!$this->tank_auth->is_logged_in()){
			redirect("auth/login");
		}
  }
  
}
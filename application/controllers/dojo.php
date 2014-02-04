<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dojo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));
		$this->load->model(array('dojo_model'));
	}

	function index()
	{
		if($this->tank_auth->is_logged_in()){
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
		} else {
			$data['username'] = NULL;
			$data['user_data'] = NULL;
		}
		
		$filters = array(
		  'country' => NULL,
		  'need_mentors' => NULL,
		  'stage' => NULL,
		);
		if(isset($_GET['filters']) && is_array($_GET['filters'])) {
		    $where = array_intersect_key($_GET['filters'],$filters);
		    $data['dojo_data'] = $this->dojo_model->get(NULL, TRUE, NULL, $where);
		} else {
		    $data['dojo_data'] = $this->dojo_model->get(NULL, TRUE, NULL);
		}

		$this->load->view('template/header', $data);
		$this->load->view('dojo/dojo', $data);
		$this->load->view('template/footer');
	}

	function lookup()
	{
		$this->load->library('uri');
		$this->load->helper('country');

		if($this->tank_auth->is_logged_in()){
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
			$data['is_admin']   = $data['user_data']->role == 0;
		} else {
			$data['username'] = NULL;
			$data['user_data'] = NULL;
			$data['is_admin']   = false;
		}
		
		$data['dojo_data'] = $this->dojo_model->get($this->uri->segment(2));
		if(!empty($data['dojo_data']) && $vfby = $this->users->get_user_by_id($data['dojo_data'][0]->verified_by,1)) {
		    $data['verified_by'] = $vfby->email;
		} else {
		    $data['verified_by'] = "Unknown";
		}

		$this->load->view('template/header', $data);
		($data['dojo_data'] != NULL)?$this->load->view('dojo/profile', $data):$this->load->view('dojo/404', $data);
		$this->load->view('template/footer', $data);
	}

	function create()
	{
		$this->load->model(array('charter_model'));
	    if(!Charter_Model::userHasSigned($this->tank_auth->get_user_data()->user_id)) {
	        $this->session->set_userdata('c_redirect_from', '/dojo/create');
	        redirect('/charter/sign');
	    }
	    
		if(!$this->tank_auth->is_logged_in()){
			redirect("auth/login");
		} else {
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
			$data['dojo_data'] = $this->dojo_model->get($data['user_data']->dojo);
			//check if the user already has a Dojo
			$this->load->view('template/header', $data);

				//set validation rules
				$this->form_validation->set_rules('dojo_name', 'Dojo Name', 'trim|required|xss_clean|min_length[4]|max_length[100]|htmlspecialchars');
				$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
				$this->form_validation->set_rules('google_group', 'Google Group URL', 'trim|xss_clean|prep_url|htmlspecialchars');
				$this->form_validation->set_rules('twitter', 'Twitter', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('website', 'Website', 'trim|xss_clean|prep_url');
				$this->form_validation->set_rules('time', 'Time', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean|callback_is_country');
				$this->form_validation->set_rules('location', 'Location', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('coordinates', 'Co-ordinates', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('eb_id', 'EventBrite ID', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('notes', 'Notes', 'trim|xss_clean');
				$this->form_validation->set_rules('need_mentors', 'Need Mentors', 'trim|xss_clean');
				$this->form_validation->set_rules('stage', 'Stage', 'trim|xss_clean|is_natural');
				$this->form_validation->set_rules('private', 'Private', 'trim|xss_clean');
				$this->form_validation->set_rules('supporter_image', 'Supporter Image', 'trim|xss_clean|prep_url|htmlspecialchars');
				

				$data['errors'] = array();

				if ($this->form_validation->run()) { // validation ok
					if (!is_null($dojo_id = $this->dojo_model->create(
					$this->form_validation->set_value('dojo_name'),
					$this->form_validation->set_value('time'),
					$this->form_validation->set_value('country'),
					$this->form_validation->set_value('location'),
					$this->form_validation->set_value('coordinates'),
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('google_group'),
					$this->form_validation->set_value('website'),
					$this->form_validation->set_value('twitter'),
					$this->form_validation->set_value('notes'),
					$this->form_validation->set_value('eb_id'),
					$this->form_validation->set_value('need_mentors'),
					$this->form_validation->set_value('stage'),
					$this->form_validation->set_value('supporter_image'),
					$data['user_data']->user_id,
					$this->form_validation->set_value('private')
					))) {									// success
					    $this->load->library('email');
                        $this->email->from($data['user_data']->email);
                        $this->email->to('startadojo@coderdojo.com'); 
                        $this->email->subject('Zen Verification: '.$this->form_validation->set_value('dojo_name'));
                        $this->email->message(
                            'There has been a new listing created on Zen:'."\r\n\r\n".
                            'Name: '.$this->form_validation->set_value('dojo_name')."\r\n".
                            'Location: '.$this->form_validation->set_value('location').", ".
                            $this->form_validation->set_value('country')."\r\n".
                            'Stage: '.$this->form_validation->set_value('stage')."\r\n".
                            'Link: http://zen.coderdojo.com/dojo/'.$dojo_id."\r\n\r\n".
                            'This was automatically generated by zen.coderdojo.com'
                        );	

                        $this->email->send();

						if($this->input->post('mailing_list') === "Yes") {
							try {
								require_once(APPPATH.'libraries/mailchimp/Mailchimp.php');
								$cdlist = new Mailchimp_Lists(new Mailchimp($this->config->item('mailchimp_key')));
								$cdlist->subscribe($this->config->item('mailchimp_list'), array('email'=>$data['user_data']->email));
							} catch (Exception $e) {
								redirect('/dojo/'.$dojo_id);
							}
						}
                        
						redirect('/dojo/'.$dojo_id);

					} else { //failure
						$errors = $this->dojo_model->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $v." - ";

						$this->load->view('dojo/create', $data);
					}
				} else {
					$this->load->view('dojo/create', $data);
				}
		$this->load->view('template/footer', $data);
		}
	}


	function edit($id)
	{
      $this->load->model(array('charter_model'));
      if(!Charter_Model::userHasSigned($this->tank_auth->get_user_data()->user_id)) {
          $this->session->set_userdata('c_redirect_from', '/dojo/edit/'.$id);
          redirect('/charter/sign');
      }

	  if(!isset($id)) echo "<script type='text/javascript'>window.location = \"/dojo/my\";</script>";
		if(!$this->tank_auth->is_logged_in()){
			redirect("auth/login");
		} else {
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
			$data['id'] =  $id;

			//check if the has a Dojo
			$this->load->view('template/header', $data);

			if($this->dojo_model->user_can_edit_dojo($data['user_data']->user_id,$id)){
				//set validation rules
				$this->form_validation->set_rules('dojo_name', 'Dojo Name', 'trim|required|xss_clean|min_length[4]|max_length[100]|htmlspecialchars');
				$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email|required');
				$this->form_validation->set_rules('google_group', 'Google Group URL', 'trim|xss_clean|prep_url|htmlspecialchars');
				$this->form_validation->set_rules('twitter', 'Twitter', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('website', 'Website', 'trim|xss_clean|prep_url');
				$this->form_validation->set_rules('time', 'Time', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean|callback_is_country');
				$this->form_validation->set_rules('location', 'Location', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('coordinates', 'Co-ordinates', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('eb_id', 'EventBrite ID', 'trim|xss_clean|htmlspecialchars');
				$this->form_validation->set_rules('notes', 'Notes', 'trim|xss_clean');
				$this->form_validation->set_rules('need_mentors', 'Need Mentors', 'trim|xss_clean');
				$this->form_validation->set_rules('stage', 'Stage', 'trim|xss_clean|is_natural');
				$this->form_validation->set_rules('supporter_image', 'Supporter Image', 'trim|xss_clean|prep_url|htmlspecialchars');
				$this->form_validation->set_rules('private', 'Private', 'trim|xss_clean');

				$data['errors'] = array();
				$data['dojo_data'] = $this->dojo_model->get($id);

				if ($this->form_validation->run()) { // validation ok

					if (!is_null($dojo_id = $this->dojo_model->update(
					$id,
					$this->form_validation->set_value('dojo_name'),
					$this->form_validation->set_value('time'),
					$this->form_validation->set_value('country'),
					$this->form_validation->set_value('location'),
					$this->form_validation->set_value('coordinates'),
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('google_group'),
					$this->form_validation->set_value('website'),
					$this->form_validation->set_value('twitter'),
					$this->form_validation->set_value('notes'),
					$this->form_validation->set_value('eb_id'),
					$this->form_validation->set_value('need_mentors'),
					$this->form_validation->set_value('stage'),
					$this->form_validation->set_value('supporter_image'),
    				$this->form_validation->set_value('private')
					))) {									// success

						redirect('/dojo/'.$dojo_id);

					} else {//failure
						$errors = $this->dojo_model->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $v." - ";
						$this->load->view('dojo/edit', $data);
					}
				} else {				
					$this->load->view('dojo/edit', $data);
				}
			} else {
    			$this->load->view('dojo/404', $data);
			}
			$this->load->view('template/footer', $data);
		}
	}
	
	function delete($id) {
	    if(!$this->tank_auth->is_logged_in()){
			redirect("auth/login");
		} else {
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
			$data['id'] = $id;
		
	        if($this->dojo_model->user_owns_dojo($data['user_data']->user_id,$id)) {
    			$this->form_validation->set_rules('confirm', 'required');
    		    if ($this->form_validation->run()) { // validation ok
                    $this->dojo_model->delete($id,1,$data['user_data']->user_id);
                    redirect('/dojo/my');
                } else {
        			$this->load->view('template/header', $data);
        			$this->load->view('dojo/delete', $data);
        			$this->load->view('template/footer', $data);
                }
            } else {
                $data['error'] = "Only owners can delete Dojos";
    			$this->load->view('template/header', $data);
    			$this->load->view('dojo/forbidden', $data);
    			$this->load->view('template/footer', $data);
            }
        }
	}

	function my()
	{
		if(!$this->tank_auth->is_logged_in()){
			redirect("auth/login");
		} else {
			$data['username'] = $this->tank_auth->get_username();
			$data['user_data'] =  $this->tank_auth->get_user_data();
			
            $data['dojos'] = $this->dojo_model->get_by_user($data['user_data']->user_id);
			$this->load->view('template/header', $data);
			$this->load->view('dojo/userlist', $data);
			$this->load->view('template/footer', $data);
		}
	}
	
	public function is_country($country) {
	    $this->form_validation->set_message('is_country', 'You must select a real country...');
	    return array_key_exists($country,get_countries());
	}
	
	public function json(){
	    $this->load->driver('cache', array('adapter' => 'file'));
	    
	      if(!$display_map = $this->cache->get('map')) {
	        $db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL));
            $map = array();
            
            $count = 0;

            foreach($db_dojos as $dojo) {
              $dojo = (array) $dojo;
              $coord = explode(',',$dojo['coordinates']);
              $map[$dojo['name']] = array(
                "latitude" => (float) substr(trim($coord[0]),0,10),
                "longitude" => (float) substr(trim($coord[1]),0,10),
                "id" => (int) $dojo['id'],
                "private" => (bool) $dojo['private']
              );
            }
            $display_map = $map;
            $this->cache->save('map',$map,300);
	      }
	      header('Content-type: application/json');
	      echo $this->input->get('callback')?$this->input->get('callback').'(':'';
          echo json_encode($display_map);
	      echo $this->input->get('callback')?')':'';
	}
	
	public function geojson(){
        $this->load->driver('cache', array('adapter' => 'file'));
        
        if(!$display_map = $this->cache->get('geojson_map')) {
	        $db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL));
            $map = array(
          'type' => 'FeatureCollection',
          'features' => array()
        );

        $count = 0;

        foreach($db_dojos as $dojo) {
          $dojo = (array) $dojo;
          $coord = explode(',',$dojo['coordinates']);
          $c = NULL;
          $c[] = (float) $coord[1];
          $c[] = (float) $coord[0];
          $map['features'][] = array(
            'type' => 'Feature',
            'geometry' => array(
              'type' => 'Point',
              'coordinates' => $c
            ),
            'properties' => array(
              'name' => $dojo['name'],
              "private" => (bool) $dojo['private']
            )
          );
        }
        $display_map = $map;
        $this->cache->save('geojson_map',$map,300);
        }
          header('Content-type: application/json');
          echo $this->input->get('callback')?$this->input->get('callback').'(':'';
          echo json_encode($display_map);
          echo $this->input->get('callback')?')':'';
    }
    
}

/* End of file dojo.php */
/* Location: ./application/controllers/dojo.php */

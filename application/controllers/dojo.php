<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dojo extends MY_Controller
{
	public $view_data;
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));
		$this->load->model(array('dojo_model'));
	}

	public function index()
	{		
		$filters = array(
			'country' => NULL,
			'need_mentors' => NULL,
			'stage' => NULL,
		);
		if(isset($_GET['filters']) && is_array($_GET['filters'])) {
			$where = array_intersect_key($_GET['filters'],$filters);
            $wherea = array_merge(array('stage IN'=>'(1,2,3)'),$where);
			$this->view_data['dojo_data'] = $this->dojo_model->get(NULL, TRUE, NULL, $wherea);
		} else {
			$this->view_data['dojo_data'] = $this->dojo_model->get(NULL, TRUE, NULL, array('stage IN (0,1,2,3)'=>NULL));
		}
		
		$this->load_view('dojo/dojo');
	}

	public function lookup($id)
	{
		$this->view_data['dojo_data'] = $this->dojo_model->get($id);
		if(!$this->view_data['dojo_data']) {
			$this->output->set_status_header('404');
			$this->load_view('dojo/404');
			return false;
		}
		
		$this->view_data['dojo_name'] = $this->view_data['dojo_data'][0]->name;
		if($this->view_data['dojo_data'][0]->verified == 1) {
			$this->view_data['verified_by'] = $this->users->get_user_by_id(
																					$this->view_data['dojo_data'][0]->verified_by,
																					1
																				)->email;
		} else {
			$this->view_data['verified_by'] = NULL;
		}
		
		$this->load_view('dojo/profile');
	}

	public function create()
	{
		$this->require_charter();
		$this->require_user();

		$this->view_data['errors'] = array();

		if ($this->form_validation->run('dojo')) { // validation ok
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
				$this->view_data['user_data']->user_id,
				$this->form_validation->set_value('private')?1:0
			))) {									// success
				$this->send_zendesk_email(
					$this->view_data['user_data']->email,
					$dojo_id,
					$this->form_validation->set_value('dojo_name'),
					$this->form_validation->set_value('location'),
					$this->form_validation->set_value('country'),
					$this->form_validation->set_value('stage')
				);
				if($this->input->post('mailing_list') === "Yes") {
					$this->subscribe_to_list($this->view_data['user_data']->email);
				}

				redirect('/dojo/'.$dojo_id);

			} else { //failure
				$errors = $this->dojo_model->get_error_message();
				foreach ($errors as $k => $v)	$this->view_data['errors'][$k] = $v." - ";

				$this->load_view('dojo/create');
			}
		} else {
			$this->load_view('dojo/create');
		}
	}
	
	private function send_zendesk_email($user, $dojo_id, $dojo_name, $location, $country, $stage) {
		$this->load->library('email');
		$this->email->from($this->view_data['user_data']->email);
		$this->email->to('startadojo@coderdojo.com'); 
		$this->email->subject('Zen Verification: '.$dojo_name);
		$email_data = array(
			'name' => $dojo_name,
			'location' => $location,
			'country' => $country,
			'stage' => $stage,
			'dojo_id' => $dojo_id
		);
		$this->email->message($this->load->view('email/verify-txt',$email_data,true));
		$this->email->send();
	}
	
	private function subscribe_to_list($email) {
		try {
			require_once(APPPATH.'libraries/mailchimp/Mailchimp.php');
			$cdlist = new Mailchimp_Lists(new Mailchimp($this->config->item('mailchimp_key')));
			$cdlist->subscribe($this->config->item('mailchimp_list'), array('email'=>$email));
		} catch (Exception $e) {
			redirect('/dojo/'.$dojo_id);
		}
	}

	public function edit($id)
	{
		// If a Dojo is not set then redirect the user to the listing page
		if(!isset($id)) redirect("/dojo/my");
		$this->require_user();

		$this->view_data['id'] =	$id;

		if($this->dojo_model->user_can_edit_dojo($this->view_data['user_data']->user_id,$id)){
			//set validation rules

			$this->view_data['errors'] = array();
			$this->view_data['dojo_data'] = $this->dojo_model->get($id);

			if ($this->form_validation->run('dojo')) { // validation ok

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
					$this->form_validation->set_value('private')?1:0
				))) {									// success

					redirect('/dojo/'.$dojo_id);

				} else {//failure
					$errors = $this->dojo_model->get_error_message();
					foreach ($errors as $k => $v)	$this->view_data['errors'][$k] = $v." - ";
					$this->load_view('dojo/edit');
				}
			} else {				
				$this->load_view('dojo/edit');
			}
		} else {
			$this->output->set_status_header('404');
			$this->load_view('dojo/404');
		}
	}
	
	public function delete($id) {
		$this->require_user();

		$this->view_data['id'] = $id;
	
		if($this->dojo_model->user_owns_dojo($this->view_data['user_data']->user_id,$id)) {
			$this->form_validation->set_rules('confirm', 'required');
			if ($this->form_validation->run()) { // validation ok
				$this->dojo_model->delete($id,1,$this->view_data['user_data']->user_id);
				redirect('/dojo/my');
			} else {
				$this->load_view('dojo/delete');
			}
		} else {
			$this->view_data['error'] = "Only owners can delete Dojos";
			$this->load_view('dojo/forbidden');
		}
	}

	public function my()
	{
		$this->require_user();
			
		$this->view_data['dojos'] = $this->dojo_model->get_by_user($this->view_data['user_data']->user_id);
		$this->load_view('dojo/userlist');
	}
	
	// Must be public for form validation. This is a callback
	public function is_country($country) {
		$this->form_validation->set_message('is_country', 'You must select a real country...');
		return array_key_exists($country,get_countries());
	}
	
	public function json(){
		$this->load->driver('cache', array('adapter' => 'file'));
		
		if(!$display_map = $this->cache->get('map')) {
			$db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL, 'stage !=' => 4));
			$map = array();
			
			$count = 0;

			foreach($db_dojos as $dojo) {
				$dojo = (array) $dojo;
				$coord = explode(',',$dojo['coordinates']);
				$map[$dojo['name']] = array(
					"latitude" => (float) substr(trim($coord[0]),0,10),
					"longitude" => (float) substr(trim($coord[1]),0,10),
					"id" => (int) $dojo['id'],
					"private" => (bool) $dojo['private'],
					"location" => $dojo['location'],
					"country" => $dojo['alpha2'],
					"continent" => $dojo['continent'],
					"time" => $dojo['time'],
                    "link" => site_url('/dojo/'.$dojo['id']),
				);
			}
			$display_map = $map;
			$this->cache->save('map',$map,300);
		}
		$this->output
				->set_content_type('application/json')
				->set_output(
					($this->input->get('callback')?$this->input->get('callback').'(':'') .
					json_encode($display_map) .
					($this->input->get('callback')?')':'')
				);
	}

        public function cpjson(){
                $this->load->driver('cache', array('adapter' => 'file'));

                if(!$display_map = $this->cache->get('cpjson')) {
                        $db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('stage !=' => 4));
                        $map = array();

                        $count = 0;

                        foreach($db_dojos as $dojo) {
                                $dojo = (array) $dojo;
                                $lat = null; $long = null;
                                if($dojo['coordinates'] != NULL) {
                                        $coord = explode(',',$dojo['coordinates']);
                                        $lat = $coord ? substr(trim($coord[0]),0,10) : NULL;
                                        $long = $coord ? substr(trim($coord[1]),0,10) : NULL;
                                }
                                $map[$dojo['name']] = array(
                                        "latitude" => $lat,
                                        "longitude" => $long,
                                        "id" => (int) $dojo['id'],
                                        "private" => (bool) $dojo['private'],
                                        "location" => $dojo['location'],
                                        "country" => $dojo['alpha2'],
                                        "continent" => $dojo['continent'],
                                        "time" => $dojo['time'],
                    "link" => site_url('/dojo/'.$dojo['id']),
                                );
                        }
                        $display_map = $map;
                        $this->cache->save('map',$map,300);
		}
		$this->output
				->set_content_type('application/json')
				->set_output(
					($this->input->get('callback')?$this->input->get('callback').'(':'') .
					json_encode($display_map) .
					($this->input->get('callback')?')':'')
				);
	}
	
	public function geojson(){
		$this->load->driver('cache', array('adapter' => 'file'));
	
		if(!$display_map = $this->cache->get('geojson_map')) {
			$db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL, 'stage !=' => 4));
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
						"private" => (bool) $dojo['private'],
						"location" => $dojo['location'],
						"time" => $dojo['time']
					)
				);
			}
			$display_map = $map;
			$this->cache->save('geojson_map',$map,300);
		}
		$this->output
				->set_content_type('application/json')
				->set_output(
					($this->input->get('callback')?$this->input->get('callback').'(':'') .
					json_encode($display_map) .
					($this->input->get('callback')?')':'')
				);
		}
		
}

/* End of file dojo.php */
/* Location: ./application/controllers/dojo.php */

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('dojo_model'));
	}
    
    function stats() {
        $this->load->driver('cache', array('adapter' => 'file'));
        if(!$response = $this->cache->get('dojocount')) {
	        $dojo_count = $this->dojo_model->dojo_count();
	        $country_count = $this->dojo_model->country_count();
	        $response['number_of_dojos'] = $dojo_count;
            $response['estimated_number_of_kids'] = $dojo_count * 32;
            $response['estimated_number_of_mentors'] = $dojo_count * 5;
	        $response['number_of_countries'] = $country_count;
            $this->cache->save('dojocount',$response,120);
        }
        $this->output
            ->set_header('Access-Control-Allow-Origin: http://*.coderdojo.com')
            ->set_header('Access-Control-Allow-Origin: http://coderdojo.com')
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
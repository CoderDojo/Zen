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
            ->set_header('Access-Control-Allow-Origin: *')
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    
    function dojos($geojson = false) {
      if($geojson) {
        $this->dojos_geojson();
      } else {
        $this->dojos_json();
      }
    }
    
    private function dojos_json() {
      $this->load->driver('cache', array('adapter' => 'file'));
	    
	      if(!$display_map = $this->cache->get('api_map')) {
	        $db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL, 'private' => false));
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
                "time" => $dojo['time'],
                "country" => $dojo['country'],
                "name" => $dojo['name'],
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
    
    private function dojos_geojson() {
      $this->load->driver('cache', array('adapter' => 'file'));
      
      if(!$display_map = $this->cache->get('api_geojson_map')) {
        $db_dojos = $this->dojo_model->get(NULL, TRUE, FALSE, array('coordinates IS NOT NULL' => NULL, 'private' => false));
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
            "time" => $dojo['time'],
            "country" => $dojo['country'],
            "name" => $dojo['name'],
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
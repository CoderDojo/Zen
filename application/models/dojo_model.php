<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dojo_Model extends CI_Model
{
	private $error = array();
	private $dojo_table = "dojos";
	private $user_dojo_table = "user_dojos";

	function __construct(){
		parent::__construct();
	}

	/**
	 * Return data from existing dojo
	 *
	 */
	function get($id = NULL, $verified = NULL, $unverified = NULL, $where = array() ){
	    $default_where = array(
	       'deleted' => 0
	    );
		if ($id) {
			$this->db->where('id', $id);
		}

		if ($verified){
			$this->db->where('verified', 1);
		}

        if ($unverified){
			$this->db->where('verified !=',1);
		}
		
		$where_f = array_merge($default_where, $where);
		foreach($where_f as $key => $val) {
		    $this->db->where($key,$val,true);
		}
		
		$this->db->where('deleted',0);
		$this->db->order_by('country desc, name asc');
		$query = $this->db->get($this->dojo_table);
		return $query->result();
	}
	
	function get_with_user($id = NULL, $verified = NULL, $unverified = NULL, $where = array()){
	    $default_where = array(
	       'deleted' => 0
	    );
	    
	    $this->db->select('users.email as useremail, dojos.id as dojoid, name, country, dojos.email as dojoemail, verified, deleted');
		if ($id) {
			$this->db->where('dojos.id', $id);
		}
		
		if ($verified){
			$this->db->where('dojos.verified', 1);
		}

        if ($unverified){
			$this->db->where('dojos.verified !=',1);
		}
		
		$where_f = array_merge($default_where, $where);
		foreach($where_f as $key => $val) {
		    $this->db->where($key,$val,true);
		}
		$this->db->join("users", "dojos.creator = users.id");
		
		$this->db->order_by('dojos.id desc');
		$query = $this->db->get($this->dojo_table);
		return $query->result();
	}
	
	function get_by_user($user_id) {
	    $this->db->join($this->dojo_table,'user_dojos.dojo_id = dojos.id');

		$this->db->where('user_dojos.user_id',$user_id);
		$this->db->where('deleted',0);
		$this->db->order_by('id asc');
		$query = $this->db->get($this->user_dojo_table);
		return $query->result();
	}

	/**
	 * Create a dojo listing
	 *
	 */
	function create($name, $time, $country, $location, $coordinates, $email, $google_group, $website, $twitter, $notes, $eb_id, $need_mentors, $stage, $supporter_image, $user_id, $private){
	    
		if ((strlen($name) > 0) AND !$this->is_name_available($name)) {
			$this->error = array('dojo_name' => 'Dojo Name is use, pick another');
		} else {
			$data = array(
			'name' => $name,
			'creator' => $user_id,
			'time' => $time,
			'country' => $country,
			'location' => $location,
			'coordinates' => $coordinates,
			'email' => $email,
			'google_group' => $google_group,
			'website' => $website,
			'twitter' => $twitter,
			'notes' => $notes,
			'eb_id' => $eb_id,
			'need_mentors' => (($need_mentors == FALSE)?FALSE:TRUE),
			'stage' => $stage,
			'supporter_image' => $supporter_image,
			'private' => $private,
			);

			$query = $this->db->insert($this->dojo_table, $data);
			$insert_id = $this->db->insert_id();
			$this->add_user_dojo($insert_id, $user_id, true /* is owner*/);
			return $insert_id;
		}
		return NULL;
	}

	/**
	 * Update existing dojo listing
	 *
	 */
	function update($id, $name, $time, $country, $location, $coordinates, $email, $google_group, $website, $twitter, $notes, $eb_id, $need_mentors, $stage, $supporter_image, $private){

		$dojo_data = $this->get($id);

		if ((strlen($name) > 0) AND !$this->is_name_available($name) && strtolower($dojo_data[0]->name) != strtolower($name)) {
			$this->error = array('dojo_name' => 'Dojo Name is use, pick another');
		} else{
			$this->db->where('id', $id);
			$this->db->where('deleted',0);

			$data = array(
			'name' => $name,
			'time' => $time,
			'country' => $country,
			'location' => $location,
			'coordinates' => $coordinates,
			'email' => $email,
			'google_group' => $google_group,
			'website' => $website,
			'twitter' => $twitter,
			'notes' => $notes,
			'eb_id' => $eb_id,
			'need_mentors' => (($need_mentors == FALSE)?FALSE:TRUE),
			'stage' => $stage,
			'supporter_image' => $supporter_image,
			'private' => (int) $private
			);
			$this->db->set($data);

			if($this->db->update($this->dojo_table)){
				return $id;
			}
		}

		return NULL;
	}

	/**
	 * Check if Dojo Name available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_name_available($name)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(name)=', strtolower($name));
		$this->db->where('deleted',0);

		$query = $this->db->get($this->dojo_table);
		return $query->num_rows() == 0;
	}

	/**
	 * Check if Dojo Name available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function add_user_dojo($dojo_id, $user_id, $owner = false)
	{
		$this->db->set(array('user_id'=>$user_id,'dojo_id'=>$dojo_id,'owner'=>$owner));
		$this->db->insert($this->user_dojo_table);
	}
	function remove_user_dojo($dojo_id, $user_id)
	{
		$this->db->where(array('user_id'=>$user_id,'dojo_id'=>$dojo_id));
		$this->db->delete($this->user_dojo_table);
	}

    /**
	 * Verifies the Dojo(s) inputed
	 *
	 * @param	string || array
	 * @return	bool
	 */
	function verify($dojo = NULL, $state, $user)
    {
        if($dojo){
            $this->db->set('verified', $state);
            if($state == 1) {
              $this->db->set('verified_at', "NOW()", false);
              $this->db->set('verified_by', $user);
            }
    
            $this->db->where('id', $dojo);

            $this->db->where('deleted',0);
            $this->db->update($this->dojo_table);
        }
	}
	
	function delete($dojo, $state, $user)
    {
        $this->db->set('deleted', $state);
        $this->db->set('deleted_at', "NOW()", false);
        $this->db->set('deleted_by', $user);
    
        $this->db->where('id', $dojo);

        $this->db->where('deleted',0);
        $this->db->update($this->dojo_table);
        
        $this->remove_user_dojo($dojo,$user);
	}
	
	function user_can_edit_dojo($user_id,$dojo_id) {
		$this->db->where('user_dojos.user_id',$user_id);
		$this->db->where('user_dojos.dojo_id',$dojo_id);
		$query = $this->db->get($this->user_dojo_table);
		return $query->num_rows()===0?false:true;
	}
	function user_owns_dojo($user_id,$dojo_id) {
	    $this->db->where('user_dojos.owner',true);
		$this->db->where('user_dojos.user_id',$user_id);
		$this->db->where('user_dojos.dojo_id',$dojo_id);
		$query = $this->db->get($this->user_dojo_table);
		return $query->num_rows()===0?false:true;
	}

	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as creating or updating.
	 *
	 * @return	string
	 */
	function get_error_message()
	{
		return $this->error;
	}
}

/* End of file dojo_model.php */
/* Location: ./application/models/dojo_model.php */

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dojo_Model extends CI_Model
{
	private $error = array();
	private $dojo_table = "dojos";
	private $user_profile_table = "user_profiles";

	function __construct(){
		parent::__construct();
	}

	/**
	 * Return data from existing dojo
	 *
	 */
	function get($id = NULL, $verified = NULL, $unverified = NULL){
		if ($id) {
			$this->db->where('id', $id);
		}

		if ($verified){
			$this->db->where('verified', TRUE);
		}

        if ($unverified){
			$this->db->where('verified', FALSE);
		}

		$this->db->order_by('country', 'asc');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get($this->dojo_table);
		return $query->result();
	}

	/**
	 * Create a dojo listing
	 *
	 */
	function create($name, $time, $country, $location, $coordinates, $email, $google_group, $twitter, $notes, $eb_id, $need_mentors, $stage, $supporter_image, $user_id){
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
			'twitter' => $twitter,
			'notes' => $notes,
			'eb_id' => $eb_id,
			'need_mentors' => (($need_mentors == FALSE)?FALSE:TRUE),
			'stage' => $stage,
			'supporter_image' => $supporter_image,
			);

			$query = $this->db->insert($this->dojo_table, $data);
			$insert_id = $this->db->insert_id();
			$this->update_user_dojo($insert_id, $user_id);
			return $insert_id;
		}
		return NULL;
	}

	/**
	 * Update existing dojo listing
	 *
	 */
	function update($id, $name, $time, $country, $location, $coordinates, $email, $google_group, $twitter, $notes, $eb_id, $need_mentors, $stage, $supporter_image){

		$dojo_data = $this->get($id);

		if ((strlen($name) > 0) AND !$this->is_name_available($name) && strtolower($dojo_data[0]->name) != strtolower($name)) {
			$this->error = array('dojo_name' => 'Dojo Name is use, pick another');
		} else{
			$this->db->where('id', $id);

			$data = array(
			'name' => $name,
			'time' => $time,
			'country' => $country,
			'location' => $location,
			'coordinates' => $coordinates,
			'email' => $email,
			'google_group' => $google_group,
			'twitter' => $twitter,
			'notes' => $notes,
			'eb_id' => $eb_id,
			'need_mentors' => (($need_mentors == FALSE)?FALSE:TRUE),
			'stage' => $stage,
			'supporter_image' => $supporter_image,
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

		$query = $this->db->get($this->dojo_table);
		return $query->num_rows() == 0;
	}

	/**
	 * Check if Dojo Name available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function update_user_dojo($dojo_id, $user_id)
	{
		$this->db->set('dojo', $dojo_id);
		$this->db->where('user_id', $user_id);

		$this->db->update($this->user_profile_table);
	}

    /**
	 * Verifies the Dojo(s) inputed
	 *
	 * @param	string || array
	 * @return	bool
	 */
	function verify($dojo = NULL)
    {
        if($dojo){
            $this->db->set('verified', 1);

            if(is_array($dojo)){
                foreach($dojo as $d){
                    $this->db->or_where('id', $d);
                }
            }
            else {

                $this->db->where('id', $dojo);
            }

            $this->db->update($this->dojo_table);
        }
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

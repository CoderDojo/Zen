<?php

$config = array(
  'dojo' => array(
  	 array(
     	'field' => 'dojo_name',
     	'label' => 'Dojo Name',
     	'rules' => 'trim|required|xss_clean|min_length[4]|max_length[100]|htmlspecialchars'
     ),
     array(
     	'field' => 'email',
     	'label' => 'Email',
     	'rules' => 'trim|xss_clean|valid_email'
     ),
     array(
     	'field' => 'google_group',
     	'label' => 'Google Group URL',
     	'rules' => 'trim|xss_clean|prep_url'
     ),
     array(
     	'field' => 'twitter',
     	'label' => 'Twitter',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'website',
     	'label' => 'Website',
     	'rules' => 'trim|xss_clean|prep_url'
     ),
     array(
     	'field' => 'time',
     	'label' => 'Time',
     	'rules' => 'trim|xss_clean|htmlspecialchars'
     ),
     array(
     	'field' => 'country',
     	'label' => 'Country',
     	'rules' => 'trim|required|xss_clean|callback_is_country'
     ),
     array(
     	'field' => 'location',
     	'label' => 'Location',
     	'rules' => 'trim|xss_clean|htmlspecialchars'
     ),
     array(
     	'field' => 'coordinates',
     	'label' => 'Co-ordinates',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'eb_id',
     	'label' => 'EventBrite ID',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'notes',
     	'label' => 'Notes',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'need_mentors',
     	'label' => 'Need Mentors',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'stage',
     	'label' => 'Stage',
     	'rules' => 'trim|xss_clean|is_natural'
     ),
     array(
     	'field' => 'private',
     	'label' => 'Private',
     	'rules' => 'trim|xss_clean'
     ),
     array(
     	'field' => 'supporter_image',
     	'label' => 'Supporter Image',
     	'rules' => 'trim|prep_url'
     ),
  )
);
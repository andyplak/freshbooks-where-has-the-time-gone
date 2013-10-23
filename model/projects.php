<?php

//require('/lib/FreshBooksRequest.php');

class Projects extends FreshBooksRequest {

	private $projects;

	public function __construct( $options=array('per_page' => 100) ) {
		parent::__construct('project.list');
		$this->post( $options );
	}

	public function loadData() {

		//Todo: need to deal with pagination
		//Todo: need to add caching mechanism

		$this->request();
		if( $this->success() ) {
		  $response = $this->getResponse();
		  $this->projects = $response['projects']['project'];
		  return $this->projects;
		}else{
		  return false;
		}
	}

}
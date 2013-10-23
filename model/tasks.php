<?php

//require('/lib/FreshBooksRequest.php');

class Tasks extends FreshBooksRequest {

	private $tasks;
	private $options;

	public function __construct( $options=array('per_page' => 100) ) {
		parent::__construct('task.list');
		$this->post( $options );
	}

	public function loadData() {

		//Todo: need to deal with pagination
		//Todo: need to add caching mechanism

		$this->request();
		if( $this->success() ) {
		  $response = $this->getResponse();
		  $this->tasks = $response['tasks']['task'];
		  return $this->tasks;
		}else{
		  return false;
		}
	}

}
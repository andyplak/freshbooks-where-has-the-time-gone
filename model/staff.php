<?php

//require('/lib/FreshBooksRequest.php');

class Staff extends FreshBooksRequest {

	private $members;

	public function __construct( $options=array('per_page' => 100) ) {
		parent::__construct('staff.list');
		$this->post( $options );
	}

	public function loadData() {

		//Todo: need to deal with pagination
		//Todo: need to add caching mechanism

		$this->request();
		if( $this->success() ) {
		  $response = $this->getResponse();



		  // unique to staff
		  array_shift( $response['staff_members'] ); // remove @attributes array
		  $this->members = $response['staff_members'];
		  return $this->members;
		}else{
		  return false;
		}
	}

}
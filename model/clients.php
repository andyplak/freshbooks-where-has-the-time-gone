<?php

require('/lib/FreshBooksRequest.php');

class Clients extends FreshBooksRequest {

	private $clients;

	public function __construct( $options=array('folder' => 'active') ) {
		parent::__construct('client.list');
		$this->post( $options );
	}

	public function loadData() {

		//Todo: need to deal with pagination
		//Todo: need to add caching mechanism

		$this->request();
		if( $this->success() ) {
		  $response = $this->getResponse();
		  $this->clients = $response['clients']['client'];
		  return $this->clients;
		}else{
		  return false;
		}
	}

}
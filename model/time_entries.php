<?php

//require('/lib/FreshBooksRequest.php');

class TimeEntries extends FreshBooksRequest {

	private $timeEntries;
	private $options;

	public function __construct( $options=array() ) {
		parent::__construct('time_entry.list');

		if( empty( $options ) ) {
			$options = array(
    		'date_from' => date('Y-m-01'),
    		'date_to' => date('Y-m-m'),
    		'per_page' => 100
			);
		}
		$this->options = $options;
		$this->post( $options );
	}

	public function loadData( $retrieveAll=true ) {

		//Todo: need to deal with pagination
		//Todo: need to add caching mechanism

		$this->request();
		if( $this->success() ) {


			// Cache it



		  $response = $this->getResponse();
		  $this->timeEntries = $response['time_entries']['time_entry'];

		  /*
		  if $retrieveAll && response['@blahblah'] total > 1 page
		  	for all pages

		  		$this->options['page'] = $this->options['page']+1;
					$this->post( $this->options );
					$this->request();
					$response = $this->getResponse();

					if( $this->success() ) {
						$this->timeEntries = array_merge( $this->timeEntries, $response['time_entries']['time_entry'] );
					}else{
						// append from cache
						// or
						// return false
					}

*/
		  return $this->timeEntries;
		}else{
			// Pull from cache? // Check if more than 100 results?

		  return false;
		}
	}

	/**
	 * Calculate total hours per field from loaded time entry data
	 * @param $field - field to total the hours by. Valid values project, task, staff, date
	 */
	public function getHoursBy($field) {
		$ret = array();

		if($field != 'date') {
			$field = $field.'_id';
		}

		foreach( $this->timeEntries as $entry ) {
			if( !isset( $ret[ $entry[ $field ] ] ) ) {
				$ret[ $entry[ $field ] ] = floatval( $entry['hours'] );
			}else{
				$ret[ $entry[ $field ] ] = floatval( $entry['hours'] ) + $ret[ $entry[ $field ] ];
			}
		}
		return $ret;
	}

}
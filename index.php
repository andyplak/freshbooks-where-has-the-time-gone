<?php
require('config.php');
require('model/clients.php');



// Receive filter values / process with default
// Collect Data
// Display via views




// Setup the login credentials
FreshBooksRequest::init(FB_SUBDOMAIN, TOKEN);

$clients = new Clients();
if( $client_data = $clients->loadData() ) {
    echo '<ul>';
    foreach( $client_data as $client ) {
        echo '<li>'.$client['organization'].'</li>';
    }
    echo '</ul>';
}else{
    var_dump( $clients->getError() );
}



/**********************************************
 * Fetch all active projects
 **********************************************/
/*
$fb = new FreshBooksRequest('project.list');
$fb->request();
if($fb->success())
{
    //echo '<p>Projects</p><ul>';
    $response = $fb->getResponse();
    $projects = $response['projects']['project'];
    foreach($projects as $project) {
        echo '<li>'.$project['name'].'</li>';
    }
    echo '</ul>';
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}

$fb = new FreshBooksRequest('time_entry.list');
$fb->post(array(
    'date_from' => '2013-09-01',
    'date_to' => '2013-09-30',
    'per_page' => 100
));
$fb->request();
if($fb->success())
{
    $response = $fb->getResponse();
var_dump($response['time_entries']['@attributes']);
    $time_entries = $response['time_entries']['time_entry'];
    foreach($time_entries as $time_entry) {
        echo '<li>'.$time_entry['date'].' - '.$time_entry['hours'].'</li>';
    }
    echo '</ul>';
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}

*/

/**********************************************
 * List invoices from a specific client
 **********************************************/
/*
$fb = new FreshBooksRequest('invoice.list');
$fb->post(array(
    'client_id' => 41
));
$fb->request();
if($fb->success())
{
    var_dump($fb->getResponse());
}
else
{
    echo $fb->getError();
    var_dump($fb->getResponse());
}
*/

?>